/home/murilo/clever/clever "$1" 2> "$1".err &

PID=$!

kill -0 $PID > /dev/null 2>&1 || exit 0
sleep 1
kill -0 $PID > /dev/null 2>&1 || exit 0
sleep 1

kill -9 $PID > /dev/null 2>&1

if [ $? -eq 0 ]
then
	echo "Process killed because exceeded the time limit"
fi
