<?php

/* Reminder: always indent with 4 spaces (no tabs). */
// +---------------------------------------------------------------------------+
// | Geeklog 1.5                                                               |
// +---------------------------------------------------------------------------+
// | japanese_utf-8.php                                                        |
// |                                                                           |
// | Japanese language file for the Geeklog installation script                |
// +---------------------------------------------------------------------------+
// | Copyright (C) 2000-2008 by the following authors:                         |
// |                                                                           |
// | Authors: Tony Bibbs        - tony AT tonybibbs DOT com                    |
// |          Mark Limburg      - mlimburg AT users DOT sourceforge DOT net    |
// |          Jason Whittenburg - jwhitten AT securitygeeks DOT com            |
// |          Dirk Haun         - dirk AT haun-online DOT de                   |
// |          Randy Kolenko     - randy AT nextide DOT ca                      |
// |          Matt West         - matt AT mattdanger DOT net                   |
// |          Geeklog.jp group  - info AT geeklog DOT jp                       |
// |          mystral-kk        - geeklog AT mystral-kk DOT net                |
// +---------------------------------------------------------------------------+
// |                                                                           |
// | This program is free software; you can redistribute it and/or             |
// | modify it under the terms of the GNU General Public License               |
// | as published by the Free Software Foundation; either version 2            |
// | of the License, or (at your option) any later version.                    |
// |                                                                           |
// | This program is distributed in the hope that it will be useful,           |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
// | GNU General Public License for more details.                              |
// |                                                                           |
// | You should have received a copy of the GNU General Public License         |
// | along with this program; if not, write to the Free Software Foundation,   |
// | Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.           |
// |                                                                           |
// +---------------------------------------------------------------------------+
//
// $Id: japanese_utf-8.php,v 1.3 2008/06/05 18:48:35 dhaun Exp $

// +---------------------------------------------------------------------------+

$LANG_CHARSET = 'utf-8';

// +---------------------------------------------------------------------------+
// | Array Format:                                                             |
// | $LANG_NAME[XX]: $LANG - variable name                                     |
// |                 NAME  - where array is used                               |
// |                 XX    - phrase id number                                  |
// +---------------------------------------------------------------------------+

// +---------------------------------------------------------------------------+
// install.php

$LANG_INSTALL = array(
    0 => 'Geeklog - The Ultimate Weblog System',
    1 => 'インストールで困ったら，こちらのサイトへ',
    2 => 'The Ultimate Weblog System',
    3 => 'Geeklogのインストール',
    4 => 'PHP 4.1.0が必要です',
    5 => '残念ですが，Geeklogをインストールするには最低でもPHP 4.1.0が必要です(現在のバージョンは ',
    6 => ')。自分で<a href="http://www.php.net/downloads.php">PHPをバージョンアップする</a>か，ホスティング会社に依頼してください。',
    7 => 'Geeklogのファイルがどこにあるかわかりません',
    8 => 'Geeklogの重要なファイルがどこにあるかわかりません。たぶん，デフォルトの位置から移動させているためでしょう。下のテキストボックスにファイルのパスを入力してください。:',
    9 => 'Geeklogへようこそ!　Geeklogを選んでいただき，ありがとうございます。',
    10 => 'ファイル/ディレクトリ',
    11 => 'パーミッション',
    12 => '変更値',
    13 => '現在',
    14 => 'ディレクトリの変更値',
    15 => 'Geeklogのヘッドライン(RSS)が無効になっています。<code>backend</code>ディレクトリのテストを行いませんでした。',
    17 => 'ユーザ写真が無効になっています。<code>userphotos</code>ディレクトリのテストを行いませんでした。',
    18 => '記事に画像を添付する機能が無効になっています。<code>articles</code>ディレクトリのテストを行いませんでした。',
    19 => 'Geeklogでは，いくつかのファイルとディレクトリがWebサーバから書き込める必要があります。以下は，変更する必要のあるファイルとディレクトリの一覧です。',
    20 => '警告!',
    21 => '上記のエラーが解消されるまで，あなたのGeeklogサイトは正常に動作しないでしょう。先へ進む前に，必要な変更を行ってください。',
    22 => '不明',
    23 => 'インストールの種類を選択してください:',
    24 => '新規インストール',
    25 => 'アップグレード',
    26 => '変更できませんでした：',
    27 => '。ファイルはWebサーバから書き込みできますか?',
    28 => 'siteconfig.php。このファイルはWebサーバから書き込みできますか?',
    29 => 'Geeklog Site',
    30 => 'Another Nifty Geeklog Site',
    31 => '必須の設定情報',
    32 => 'サイト名',
    33 => 'サイトのスローガン',
    34 => 'データベースの種類',
    35 => 'MySQL',
    36 => 'MySQL（InnoDBテーブルをサポート）',
    37 => 'Microsoft SQL',
    38 => '',
    39 => 'データベースのホスト名',
    40 => 'データベース名',
    41 => 'データベースのユーザ名',
    42 => 'データベースのパスワード',
    43 => 'データベースの接頭子',
    44 => 'オプションの設定',
    45 => 'サイトのURL',
    46 => '(最後にスラッシュをつけない)',
    47 => 'Adminディレクトリのパス',
    48 => 'サイトのEmail',
    49 => 'サイトのNo-Reply Email',
    50 => 'インストール',
    51 => '少なくともMySQL 3.23.2が必要です',
    52 => '残念ですが，Geeklogをインストールするには最低でもMySQL 3.23.2が必要です(現在のバージョンは ',
    53 => ')。自分で<a href="http://dev.mysql.com/downloads/mysql/">MySQLをアップグレードする</a>か，ホスティング会社に依頼してください。',
    54 => 'データベース情報が不正確です',
    55 => '残念ですが，入力したデータベース情報が不正確なようです。戻ってやり直してください。',
    56 => 'データベースに接続できません',
    57 => '残念ですが，指定されているデータベースが見つかりません。データベースが存在しないか，綴り（大文字小文字）が違うのでしょう。戻ってやり直してください。',
    58 => '。このファイルはWebサーバから書き込みできますか?',
    59 => '情報:',
    60 => 'お使いのMySQLのバージョンではInnoDBテーブルはサポートされていません。InnoDBサポートなしで，インストールを続けますか?',
    61 => '戻る',
    62 => '続ける',
    63 => 'インストール済みのGeeklogのデータベースが既に存在しています。既存のGeeklogデータベースを上書きして新規インストールを行うことはできません。続けるには，次のどれかを行ってください:',
    64 => '1. 既存のデータベースからテーブルを削除する。2. データベースを削除してから作成し直す。その後，下の"再試行"をクリックしてください。',
    65 => '下の"アップグレード"オプションを選択することで，(Geeklogの新バージョンへ)データベースのアップグレードを行います。',
    66 => '再試行',
    67 => 'Geeklogのデータベースを設定中にエラーが発生しました', 
    68 => 'データベースが空ではありません。データベース中のテーブルを全て削除してから，やり直してください。',
    69 => 'Geeklogをアップグレード',
    70 => '始める前に現在のGeeklogのデータベースのバックアップを行ってください。インストール・スクリプトはGeeklogのデータベースを変更するので，失敗してアップグレードをやり直すには，オリジナルのデータベースのバックアップが必要になります。警告しましたよ!',
    71 => '現在のGeeklogのバージョンを下で正確に選択してください。インストール・スクリプトは入力されたバージョンから少しずつアップグレードしていきます（つまり，任意の古いバージョンから次のバージョンへアップグレードできます: ',
    72 => '）。',
    73 => 'インストール・スクリプトはGeeklogのベータ版やリリース候補(RC)版からのアップグレードは行いません。',
    74 => 'データベースは既に最新の状態になっています!',
    75 => 'データベースは既に最新の状態になっているようです。以前，アップグレードを実行したことがあるのでしょう。ふたたびアップグレードを実行する必要があるなら，データベースのバックアップから復元を行ってからにしてください。',
    76 => '現在のGeeklogのバージョンを選択してください',
    77 => 'インストーラは現在のGeeklogのバージョンを判定できませんでした。下のリストから選択してください:',
    78 => 'アップグレードエラー',
    79 => 'Geeklogをアップグレード中にエラーが発生しました。',
    80 => '変更',
    81 => 'ちょっと待って!',
    82 => '下に列挙されたファイルのパーミッションを必ず変更する必要があります。変更するまでGeeklogをインストールできません。',
    83 => 'インストールエラー',
    84 => 'パス "',
    85 => '" は正しくありません。戻ってやり直してください。',
    86 => '言語',
    87 => 'http://www.geeklog.net/forum/index.php?forum=1',
    88 => 'ディレクトリとその中にあるファイルの変更値',
    89 => '現在のバージョン:',
    90 => 'データベースは空?',
    91 => 'データベースが空のままか，入力してデータベースの情報が不正確なようです。ひょっとすると，アップグレードではなく，新規インストールするつもりだったのではないでしょうか?　戻ってやり直してください。',
    92 => 'UTF-8を使用する'
);

// +---------------------------------------------------------------------------+
// success.php

$LANG_SUCCESS = array(
    0 => 'インストール完了',
    1 => 'Geeklog ',
    2 => ' のインストールが完了しました!',
    3 => 'おめでとうございます。Geeklogの',
    4 => 'に成功しました。少し時間をさいて，下に表示されている情報をご覧ください。',
    5 => '新しいGeeklogサイトにログインするには，次のアカウントを使用してください。',
    6 => 'ユーザ名:',
    7 => 'Admin',
    8 => 'パスワード:',
    9 => 'password',
    10 => 'セキュリティ警告',
    11 => '次の',
    12 => 'つのことを忘れずに行ってください',
    13 => 'installディレクトリを削除するかリネームする: ',
    14 => '',
    15 => 'アカウントのパスワードを変更する',
    16 => '',
    17 => 'と',
    18 => 'のパーミッションを次のものに変更する: ',
    19 => '<strong>情報:</strong> セキュリティモデルを変更したので，新しいサイトの管理を行うのに必要な権限を持ったアカウントを作成しました。ユーザ名は <strong>NewAdmin</strong> で，パスワードは <strong>password</strong> です。',
    20 => 'インストール',
    21 => 'アップグレード'
);

// +---------------------------------------------------------------------------+
// help.php (TBD)

$LANG_HELP = array(
    0 => 'インストールヘルプ',
    1 => 'サイト名を入力します。後から変更することもできます。',
    2 => 'サイトのスローガンを入力します。後から変更することもできます。',
    3 => 'データベースの種類を入力します。MySQL, MySQL(InnoDB), Microsoft SQL Serverの中から選びます。<br><br><strong>注意:</strong> 大規模なサイトでは，InnoDBテーブルを使用すれば，パフォーマンスが改善されるかもしれませんが，バックアップを行うのが難しくなります。',
    4 => 'ホスト名を入力します。',
    5 => 'データベース名を入力します。',
    6 => 'データベースのユーザ名（アカウント）を入力します。',
    7 => 'パスワードを入力します。',
    8 => 'テーブル名の接頭子を入力します。データベース内に他にテーブルがなければ，既定値を変更する必要はありません。',
    9 => 'サイトのURLを入力します。',
    10 => 'AdminディレクトリのURLを入力します。',
    11 => 'サイト管理者のEmailアドレスを入力します。',
    12 => 'サイト管理者のNo-Reply Email（返信を受け付けないEmailアドレス）を入力します。',
    13 => 'サイトのデフォルト言語としてUTF-8を使用するかどうかを指示します。多言語サイトを作成するなら，チェックを入れることをお勧めします。'
);

?>