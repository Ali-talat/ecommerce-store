<?php

function getDefulteLang(){
   return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}
define('PAGINATION_COUNT',5);