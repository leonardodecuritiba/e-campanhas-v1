<?php

namespace App\Traits;

use App\Helpers\DataHelper;

trait ProductValuesTrait {

    public function getOriginalValueFormattedAttribute()
    {
    	return $this->product->price_formatted;
    }

    public function getOriginalValueAttribute()
    {
    	return $this->product->price;
    }

    public function getValueFormattedAttribute()
    {
    	return DataHelper::getFloat2Currency($this->getAttribute('value'));
    }

    public function getTotalAttribute()
    {
	    return ($this->getAttribute('value') * $this->getAttribute('quantity'));
    }

    public function getTotalFormattedAttribute()
    {
    	return DataHelper::getFloat2Currency($this->total);
    }

    public function getRangeValueAttribute()
    {
        return ($this->getAttribute('value') == 0) ? 0 : ( $this->product->cost / $this->getAttribute('value') );
    }


    public function getRangeValueFormattedAttribute()
    {
        return DataHelper::getFloat2Percent($this->range_value);
    }

}
