<?php
class Parameter extends BaseModel 
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parameter';



    public function scopeOptions( $query, $group ) 
    {

    	$list = [];
    	if ( ! ($result = $query->where('group', $group)->orderBy('order')->get()) ) {
    		return [];
    	}
    	foreach ( $result as $row ) {
    		$list[ $row->key ] = $row->value;
    	}
    	return $list;

    }


}