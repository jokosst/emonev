<?php

class Table extends Eloquent
{
	public static function countRowSpan( $Kegiatan ){
		$rowspan = 1;
		foreach( $Kegiatan as $kegiatan ){
			$rowspan += count($kegiatan);
			if ( count($kegiatan) == 1 )
			{
				$rowspan++;
			}
		}

		return $rowspan;
	}
}