<?php

if (strpos(strtolower($_SERVER['PHP_SELF']), 'custom_templatesetvars.php') !== false) {
    die('This file can not be used on its own!');
}

/**
* Include any code in this function to add custom template variables.
*
* Called from within Geeklog for:
* - 'header' (site header)
* - 'footer' (site footer)
* - 'storytext', 'featuredstorytext', 'archivestorytext' (story templates)
* - 'story' (story submission)
* - 'comment' (comment submission form)
* - 'registration' (user registration form)
* - 'contact' (email user form)
* - 'emailstory' (email story to a friend)
* - 'loginblock' (login form in the side bar)
* - 'loginform' (login form in the content area)
* - 'search' (advanced search form; simple search is usually part of 'header')
*
* This function is called whenever PLG_templateSetVars is called, i.e. in
* addition to the templates listed here, it may also be called from plugins.
*
* @param    string  $templatename   name of the template, e.g. 'header'
* @param    ref    &$template       reference to the template
* @return   void
* @see      PLG_templateSetVars
*
*/
function CUSTOM_templateSetVars($templatename, &$template)
{
    // define a {hello_world} variable available in header.thtml and
    // a {hello_again} variable available in the story templates

    global  $LANG01, $LANG_JPN;
    global  $_USER,$_CONF;
    global  $topic;
    global  $page;

    switch ($templatename) {
    case 'header':
        $template->set_var('hello_world', 'Hello, world!');

        //話題ID:topic_id
        $template->set_var( 'topic_id', $topic );

        //静的ページID:sp_id
        $pageurl = COM_getCurrentURL();
        if( strpos($pageurl, "staticpages") ){
            $template->set_var( 'sp_id', $page );
        }

        //HOME状態:home_id ('home','sub')
        if( COM_isFrontpage() ){
            $home_id='sub';
        } else {
            $home_id='home';
        }
        $template->set_var( 'home_id', $home_id );

        //ログインしている時
        if (COM_isAnonUser()){
                $login_status='guest';
                $prof_url_jp = "{$_CONF['site_url']}/";
        } else {
                $login_status='member';
                $prof_url_jp = "{$_CONF['site_url']}/users.php?mode=profile&amp;uid={$_USER['uid']}";
        }

        //ログイン状態:login_status ('member','guest')
        $template->set_var( 'login_status', $login_status );
        //プロフィールのURL:prof_url_jp
        $template->set_var( 'prof_url_jp', $prof_url_jp );

        break;

    case 'storytext':
    case 'featuredstorytext':
    case 'archivestorytext':
        $template->set_var('hello_again', 'Hello (again)!');
        break;
    }
}