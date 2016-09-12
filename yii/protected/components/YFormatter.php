<?php

class YFormatter extends CFormatter {
    /* @var int The text length limit for the ShortText formatter. */
    public $shortTextLimit= 20;
    
    
    /**
     * Override the default format function to allow paramters to the formatter.
     *
     * (non-PHPdoc)
     * @see CFormatter::format()
     */    
    public function format($value,$type)
    {
        $params=null;
        if(is_array($type)) {
            $params=$type;
            $type=$type['type'];
        }
        $method='format'.$type;
        if(method_exists($this,$method)) {
            if($params===null) {
                return $this->$method($value);
            } else {
                return $this->$method($value,$params);
            }
        } else {
            throw new CException(Yii::t('yii','Unknown type "{type}".',array('{type}'=>$type)));
        }
    }
    
    /**
     *
     * Text formatter shortening long texts and displaying the full text
     * as the span title.
     *
     * To be used in GridViews for instance.
     * @param string $value
     * @return string  Encoded and possibly html formatted string ('span' if the text is long).
     */
    /** Added '$params' */
    public function formatShortText($value,$params=array()) {
        if(isset($params['length'])) {
            $len=$params['length'];
        } else {
            $len=$this->shortTextLimit;
        }
        if(strlen($value)>$len) {
            $retval=CHtml::tag('span',array('title'=>$value),CHtml::encode(mb_substr($value,0,$len-3,Yii::app()->charset).'...'));
        } else {
            $retval=CHtml::encode($value);
        }
        return $retval;
    }
}

?>