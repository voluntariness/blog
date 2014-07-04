<?php
class BaseModel extends Eloquent 
{
    
    protected $field_enum = [];

    public function scopeEnum( $query, $field )
    {
        if ( ! isset($this->field_enum[ $field ]) ) {
            $type = DB::select( "SHOW COLUMNS FROM `{$this->table}` WHERE Field = ? ", [ $field ] )[0]->Type;
            preg_match('/^enum\((.*)\)$/', $type, $matches);
            $enum = explode( ',', $matches[1]);
            foreach ( $enum as &$val ) {
                $val = trim( $val, "'" );
            }
            $this->field_enum[ $field ] = $enum;
        }
        return $this->field_enum[ $field ];
    }

}