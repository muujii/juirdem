<?php 
class UserListener
{
    public function prePersist()
    {
        die('Something is being inserted!');
    }
}