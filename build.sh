#!/bin/sh

# crontab:
# */10  *  *  *  *  /home/gray/build/tonic_test/build.sh

# webhook:
# <?php echo touch('/home/gray/build/tonic_test/_build') ? 'OK' : 'Error';

FLAG_START=_build
FLAG_LOCK=_build_lock

cd `dirname $0`

if [ -f $FLAG_START ]
then
  if [ ! -f $FLAG_LOCK ]
  then
    touch $FLAG_LOCK
    rm $FLAG_START
    make pull upload install-ssh && rm $FLAG_LOCK
  fi
fi
