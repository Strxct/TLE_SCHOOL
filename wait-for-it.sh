# filepath: /c:/Users/Thimo/Desktop/projects/laravelnew_crud_10/wait-for-it.sh

#!/usr/bin/env bash
#   Use this script to test if a given TCP host/port are available

TIMEOUT=15
QUIET=0
HOST="db"
PORT="3306"

echo "Waiting for $HOST:$PORT..."

for i in `seq $TIMEOUT` ; do
    nc -z "$HOST" "$PORT" > /dev/null 2>&1
    result=$?
    if [ $result -eq 0 ] ; then
        exit 0
    fi
    sleep 1
done

echo "Operation timed out" >&2
exit 1