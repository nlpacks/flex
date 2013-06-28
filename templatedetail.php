<?php

$itemid=$_POST['id'];
if ( $itemid == 11 )
   echo '{ "success": true, "id": 1001,"filename": "f1001.xls", "desc": "1111 22222 33333 44444" }';

if ( $itemid == 12 )
   echo '{ "success": true, "id": 1002,"filename": "f1002.xls", "desc": "Simple class that represents a Request that will be made by any Ext.data.proxy.Server subclass. All this class does is standardize the representation of a Request as used by any ServerProxy subclass, it does not contain any actual logic or perform the request itself." }';

if ( $itemid == 13 )
   echo '{ "success": true, "id": 1003,"filename": "f1003.xls", "desc": "    LocalStorageProxy - saves its data to localStorage if the browser supports it    SessionStorageProxy - saves its data to sessionStorage if the browsers supports it    MemoryProxy - holds data in memory only, any data is lost when the page is refreshed" }';


?>
