<?php

namespace App\Traits;

trait Trans {

  public function getTransNameAttribute() {
      return json_decode($this->name,true)[app()->getLocale()]??'';
  }

  public function getNameEnAttribute() {
      return json_decode($this->name,true)['en']??'';
  }

   public function getNameArAttribute() {
      return json_decode($this->name,true)['ar']??'';
  }

  public function getTransBodyAttribute() {
      return json_decode($this->body,true)[app()->getLocale()]??'';
  }

  public function getbodyEnAttribute() {
      return json_decode($this->body,true)['en']??'';
  }

   public function getbodyArAttribute() {
      return json_decode($this->body,true)['ar']??'';
  }

  public function setNameAttribute() {
      
       $name = [
           'en' => request()->name_en,
           'ar' => request()->name_ar,
       ];

       $this->attributes['name'] = json_encode($name, JSON_UNESCAPED_UNICODE);
  }

  public function setBodyAttribute() {
      
       $body = [
           'en' => request()->body_en,
           'ar' => request()->body_ar,
       ];

       $this->attributes['body'] = json_encode($body, JSON_UNESCAPED_UNICODE);
  }



}















