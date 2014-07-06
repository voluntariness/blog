<?php
class Article extends BaseModel 
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'article';

    public function scopeStatus ( $query ) 
    {
    	$arr = [ 'public' => '公開', 'private' => '私人'];
    	// $row = static::enum( 'status' );
    	return [ 'public' => '公開', 'private' => '私人' ];

    }

    public function scopeMenu ( $query, $status = null )
    {

        if ( $status !== null ) {
            $query->where('status', $status );
        }
        $result = $query->select( DB::raw(" `type`, COUNT(`type`) AS 'count' "))
            ->groupBy('type')
            ->get();
        
        $types = Parameter::options('ArticleType');

        $list = [ 'all' => new stdClass() ];
        $list['all']->value = '所有文章';
        $list['all']->count = 0;
        foreach ( $types as $key => $value ) {
            $list[ $key ] = new stdClass();
            $list[ $key ]->value = $value;
            $list[ $key ]->count = 0;
        }
        foreach ( $result as $row ) {
            if ( ! isset($list[$row->key]) ) {
                continue;
            }
            $list[ $row->key ]->count = $row->count;
            $list['all']->count += $row->count;
        }
        
        return $list;

    }
}