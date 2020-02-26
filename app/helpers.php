<?php

if(!function_exists('htmlPurify')){
    function htmlPurify($string){
        $stripped = array("<script>","</script>");
        $replacement = array("","");
        return str_replace($stripped,$replacement,$string);
    }
}
?>