<?php
	class base{
		var $conec;
		
		function base(){
			$this->conec = mysqli_connect("localhost", "proy9a_user","proy9a123","proy9a");
			mysqli_query($this->conec,"SET NAMES 'utf8'");

		}
		
		
		function consulta($sql){
			return mysqli_query($this->conec, $sql);
		}
		
		function num_rows($resultado){
			return mysqli_num_rows($resultado);
		}
		
		function fetch_row($resultado){
			return mysqli_fetch_row($resultado);
		}
		
		function fetch_array($resultado){
			return mysqli_fetch_array($resultado);
		}
		

		function cerrar(){
		    mysqli_close($this->conec);
        	}
		
	}
?>