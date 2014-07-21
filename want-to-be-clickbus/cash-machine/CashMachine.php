<?php
/**
 * Classe responsável por gerenciar que conjunto de cédulas devem ser entregues para o usuário
 * @package Want-to-be-clickbus
 * @author  eltonmoura
 * @since   2014-07-19 17:00:00 
 */
class CashMachine {
	
	private $availableNotes = array();

	/**
	 * Seta as notas disponíveis na máquina
	 * @param  array $availableNotes Valores das notas disponíveis
	 * @return void
	 * @author eltonmoura
	 * @since  2014-07-19 17:00:00 
	 */
	public function setAvailableNotes( $availableNotes ){
		if ( ! is_array( $availableNotes ) ) {
			return false ;
		}
		// Manter o array ordenado na ordem inversa é importante para o funcionamento de calculateNotesFromValue
		rsort( $availableNotes );
		$this->availableNotes = $availableNotes;
	}

	/**
	 * Calcula as nostas necessárias para gerar o valor requerido considerando as notas disponíveis
	 *
	 * @param  float $value valor em dinheiro
	 * @return array notas necessárias para somar o valor informado se for possível ou uma exceção prevista
	 * @author eltonmoura
	 * @since  2014-07-19 17:00:00 
	 */
	public function getNotesFromValue( $value ){
		
		if ( $value < 0 ){
			throw new InvalidArgumentException('O valor informado não é válido.');
		}
		$aNotes = array();
		foreach ( $this->availableNotes as $note ){
			while ( $value >= $note ){
				$aNotes[] = $note;
				$value = $value - $note; 
			}
		}
		if ( $value > 0 ){
			throw new NoteUnavailableException('Não é possível fornecer notas para o valor informado.');
		}
		return $aNotes;
	}

}