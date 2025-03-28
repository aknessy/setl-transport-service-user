<?php

function hash_string($string){
    return hash("sha512", $string . config_item("encryption_key"));
}