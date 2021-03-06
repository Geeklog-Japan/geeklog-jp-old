#!/bin/sh
#
# Copyright (C) 2008-2012
# Takahiro Kambe.  All rights reserved.
#
# Redistribution and use in source and binary forms, with or without
# modification, are permitted provided that the following conditions
# are met:
#
# 1. Redistributions of source code must retain the above copyright
#    notice, this list of conditions and the following disclaimer.
# 2. Redistributions in binary form must reproduce the above copyright
#    notice, this list of conditions and the following disclaimer in the
#    documentation and/or other materials provided with the distribution.
#
# THIS SOFTWARE IS PROVIDED BY THE AUTHOR AND CONTRIBUTORS ``AS IS'' AND
# ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
# IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
# ARE DISCLAIMED.  IN NO EVENT SHALL THE AUTHOR OR CONTRIBUTORS BE LIABLE
# FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
# DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS
# OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
# HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
# LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
# OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF
# SUCH DAMAGE.
#

#
# 指定したファイルまたはディレクトリ以下のファイルに対して、改行文字
# またはUTF-8のBOM(Byte Order Mark)を含んでいないかを確認します。
#
# -l	改行文字が LF でないファイルを表示します。
# -u	UTF-8のBOMがあるファイルを表示します。
#	デフォルトはnativeです。
#
# 以下が提供されていることを動作の前提としています。
#
#	* prinfコマンド
#	* findコマンドの-print0オプション
#	* xargsコマンドの-0オプション
#
# printfコマンドはUTF-8のBOMのバイト列の生成に、他はスペースを含んだ
# ファイル名を処理するために必要です。
#

#
# 以下のサフィックスのファイルはテキストではないものとしてチェックしません。
#
binaries="bat bmp dat data gd2 gif ico jpg jpeg pdf png ttf"
excludes="/fckeditor|/system/pear"

unset LANG

usage() {
    echo "$0: [-lsu] [-p <CR|CR+LF|LF|native>] <file or dir>..."
    exit $1
}

create_arg() {
    arg=
    for i in ${binaries}; do
	arg="${arg} ! -name *.${i}"
    done
    echo $arg
}

check_files() {
    check=$1
    shift
    dir=$@

    check_arg=`create_arg`

    find ${dir} -xdev -type d \( -name .svn -o -name .hg -o -name .git \) -prune -o -type f $check_arg -print0 |
    case "${check}" in
    eol)    egrep -v "${excludes}" | xargs -0 egrep -l "`printf '\xd$'`";;
    bom)    egrep -v "${excludes}" |
	    xargs -0 egrep -l "`printf '\xef\xbb\xbf'`";;
    esac
}

check=
value=native
while getopts hlu opts; do
    case ${opts} in
	h | \?)
    	    usage 0
	    ;;
	l)
    	    check=eol
	    ;;
	u)
	    check=bom
	    ;;
	*)
	    usage 1
	    ;;
    esac
done
shift `expr $OPTIND - 1`

if [ -z "${check}" ]; then
    echo "$0: You needs to specify ether -l or -u."
    exit 1
fi

case $# in
0)	dir=.;;
*)	dir="$@";;
esac

case "${check}" in
eol|bom)	check_files ${check} ${dir};;
esac
