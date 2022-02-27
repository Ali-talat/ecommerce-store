<?php

function getDefulteLang(){
   return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}