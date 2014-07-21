<?php

class GroupSorter {

	public function sortGroup( $list , $range ) {

		if(  count( $list ) == 0  || ! is_int( $range ) ) {
			return array() ;
		}

		$groups = array();
		// coloca cada elemento no seu grupo
		foreach ( $list as $elm ){

			if( ! is_int( $elm ) ){
				throw new InvalidArgumentException('O valor informado não é válido.');
			}

			// define o indice do grupo
			$g = (int)(($elm-1)/$range) ;

			// escolhe um lugar ordenado dentro do grupo para o $elm
			$i = 0;
			if( isset( $groups[$g]) ){

				for($i = 0; $i < count( $groups[$g] ); $i++){

					if ( $elm < $groups[$g][$i] ){
						// empurra os outros elementos para frente
						for($j = count( $groups[$g] )-1; $j >= $i; $j--){
							$groups[$g][$j+1] = $groups[$g][$j];
						}
						break;
					}					
				}
			}
			$groups[$g][$i] = $elm;
		}

		// ordena os indices do array
		$keys = array_keys( $groups );
		for($i = 0; $i < count( $keys ); $i++){
			for($j = $i+1; $j < count( $keys ); $j++){
				if ( $keys[$j] < $keys[$i] ) {
					$temp = $keys[$j];
					$keys[$j] = $keys[$i];
					$keys[$i] = $temp;
				}
			}
		}

		// usa os indices ordenados
		$sorted = array() ; 
		foreach ($keys as $value) {
			$sorted[] = $groups[$value];
		}

		return $sorted ;
	}

}