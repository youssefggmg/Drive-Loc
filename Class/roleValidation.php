<?php
class roleValidation{
    private $role;
    public function isAdmine(){
        $this->role= $_COOKIE["ROLE"];
        if ($this->role!=1) {
            // readirect to the loge in page ;
            $message= "you do not have the privalige to get to this page ";
            header("location: ../index.php?message=".$message);
        }
    }
    public function isUser(){
        $this->role= $_COOKIE["ROLE"];
        if ($this->role!=1) {
            // readirect to the loge in page ;
            $message= "you do not have the privalige to get to this page ";
            header("location: index.php?message=".$message);
        }
    }
}
?>