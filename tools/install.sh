#!/bin/bash

DEST_PATH="/usr/local/data/static"
ROOT_PATH="../"

cd ${ROOT_PATH}
echo "now in "
pwd

dirs=('media' 'var')

for dr in ${dirs[@]};
do
  echo "********************************************"
  echo "Dealing dir  ${dr}..."
  echo "*******************************************"
  
  rm -f ${dr}/${dr}

  if [ -L ${dr} ]
  then
  echo "already installed, continue next"
  continue
  fi

  if [ ! -d ${DEST_PATH}/${dr} ]
  then
  echo "${DEST_PATH}/${dr} is not exist, now auto create it..."
  sudo mkdir -p  ${DEST_PATH}/${dr}
  fi
  echo "coping ..."
  
  sudo cp -af ${dr}/ ${DEST_PATH}/${dr}/

  rm -rf ${dr}
  sudo ln -s ${DEST_PATH}/${dr} ./${dr}
  echo "link made for ${dr}."

done

echo "finished....."
ls -l
