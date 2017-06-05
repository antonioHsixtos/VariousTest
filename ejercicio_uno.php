<?php 
class combinaciones_diagonal{
	private $tope = null;

	public function __construct(){
		$this->tope = 0;
	}

	public function diagonal($bc_arreglo){
		if($this->tope<=3){
			$this->tope++;
			echo "<b>Arreglo:<b><br><pre>"; print_r($bc_arreglo); echo "</pre>";
			$comb_cols 	= count($bc_arreglo);
		    $comb_rows  = count($bc_arreglo[0]);
			$data 		= array();
			$chain  	= "";
			$chain2 	= "";
			$chain3 	= "";
			$counter1 	= 0;
			$counter2 	= 0;
			foreach($bc_arreglo as $key_c => $arr_fila){
				foreach ($arr_fila as $key_f => $value) {
					if($key_c==$key_f && ( $key_c==0 || $key_c==2 ) ) {
						$chain.= $value."<br />";
					}
					if( ( $key_f-1==$key_c) || ( $key_f==$key_c-1 ) ){
						$counter1++;
						$chaining = ( ($counter1%2)==0 ) ? "<br/>" : ",";
						$chain2.= $value.$chaining;
						if($chaining=="<br/>"){
							$chain.=$chain2;
							$chain2="";
						} 
					}
					if( ( ( ( $key_f-2==$key_c) || ( $key_f==$key_c-2 ) ) || ( $key_c==$key_f && $key_c==1 ) ) && ($value%2==0) ){
						$counter2++;
						$chaining2 = ( ($counter2)==3 ) ? "<br/>" : ",";
						$chain3.= $value.$chaining2;
						if($chaining2=="<br/>"){
							$chain.=$chain3;
						}	
					 }
				}
			}
			echo "<b>Combinacion:<br>";
			echo $chain."</b><br/><br/><hr/>";
			$this->rotar($bc_arreglo);
		}
	}

	public function rotar($matriz) {
	    $comb_cols 	= count($matriz);
	    $comb_rows  = count($matriz[0]);
	    $job_array	= array();
	    for ($c = 0; $c < $comb_cols; $c++) 
	    { #columnas
	        for ($f = 0; $f < $comb_rows; $f++)
	        { #filas
            	$job_array[$c][$f] = $matriz[($comb_rows-1)-$f][$c];
	        }
	    }
	    $this->diagonal($job_array);
	}
}

$matriz = [[0, 1, 2], [3, 4, 5], [6, 7, 8]];
$class = new combinaciones_diagonal;
echo "<h3>Resultado de la impresion de diagonales:</h3>";
$class->diagonal($matriz)
?>