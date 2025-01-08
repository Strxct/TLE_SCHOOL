@extends('layout.base')
@section('content')

<div xmlns="http://www.w3.org/1999/html">
    <input type="text" placeholder="Mentor name" class="w-full text-center py-2 px-4 mt-4 border-2"/>
    <div class="py-4">
        <div style="background-color: #C8304E;" class="w-screen h-1"></div>
    </div>
</div>

<table class="w-3/4 mx-auto">
    <tbody>
    @foreach($Employes as $Employe)
        <tr>
            <td class="text-xl py-4">
                <a href="{{ route('employes.show' , $Employe->id) }}">
                {{ $Employe['firstname'] }} {{ $Employe['lastname'] }}</a>
                <input type="checkbox" class="employee-select float-right w-6 h-6" data-id="{{ $Employe->id }}" data-firstname="{{ $Employe['firstname'] }}" data-lastname="{{ $Employe['lastname'] }}">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<a href="{{ route('employes.create') }}" style="background-color: #019AAC;" class="text-white absolute inset-x-0 bottom-0 text-center py-2 px-4">Add new Employe</a>

<div id="actions-container" class="mt-4 text-center">
    <button id="edit-button" style="background-color: #019AAC;" class="bg-blue-500 text-white py-2 px-4 hidden absolute inset-x-0 w-6/12 bottom-0">Edit</button>
    <button id="delete-button" style="background-color: #C8304E;" class="text-white py-2 px-4 hidden absolute inset-x-6/12 w-6/12 bottom-0">Delete</button>
</div>

<script>
    const checkboxes = document.querySelectorAll('.employee-select');
    const editButton = document.getElementById('edit-button');
    const deleteButton = document.getElementById('delete-button');
    const selectedEmployees = new Set();

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const employeeId = checkbox.dataset.id;
            if (checkbox.checked) {
                selectedEmployees.add(employeeId);
            } else {
                selectedEmployees.delete(employeeId);
            }

            updateButtons();
        });
    });

    function updateButtons() {
        if (selectedEmployees.size === 1) {
            // Show edit and delete buttons if one employee is selected
            editButton.classList.remove('hidden');
            deleteButton.classList.remove('hidden');
            deleteButton.classList.add('w-6/12');
            deleteButton.classList.add('inset-x-6/12');
            deleteButton.classList.remove('inset-x-0');

            const employeeId = Array.from(selectedEmployees)[0];
            editButton.setAttribute('onclick', `location.href='/employes/${employeeId}/edit'`);
            deleteButton.setAttribute('onclick', `handleDelete([${employeeId}])`);
        } else if (selectedEmployees.size > 1) {
            // Only show delete button if multiple employees are selected
            editButton.classList.add('hidden');
            deleteButton.classList.remove('hidden');
            deleteButton.setAttribute('onclick', `handleDelete(${JSON.stringify(Array.from(selectedEmployees))})`);
            deleteButton.classList.remove('w-6/12');
            deleteButton.classList.remove('inset-x-6/12');
            deleteButton.classList.add('inset-x-0');
        } else {
            // Hide both buttons if no employee is selected
            editButton.classList.add('hidden');
            deleteButton.classList.add('hidden');
        }
    }

    function handleDelete(employeeIds) {
        if (confirm('Are you sure you want to delete the selected employees?')) {
            employeeIds.forEach(id => {
                const form = document.createElement('form');
                form.action = `/employes/${id}`;
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                form.submit();
            });
        }
    }

    function filterEmployees() {
        // Get the search input value
        const searchValue = document.getElementById('searchInput').value.toLowerCase();

        // Get all rows in the table
        const rows = document.querySelectorAll('.employee-row');

        // Loop through rows and show/hide based on search input
        rows.forEach(row => {
            const fullName = row.textContent.toLowerCase();
            if (fullName.includes(searchValue)) {
                row.style.display = ''; // Show row
            } else {
                row.style.display = 'none'; // Hide row
            }
        });
    }
</script>



@endsection
