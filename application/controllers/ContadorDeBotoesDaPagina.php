<?php

    class ContadorDeBotoesDaPagina{

        private $ultimaPagina;
        private $inicio;
        private $apartirDoIndiceDoVetor;
        private $quantidadesDeRegistrosParaMostrar;
        private $numeroDePaginas;
        private $quantidadeDeRegistrosNoDB;

        public function __contruct(){}

        public function contarNumeroDePaginas(
            $apartirDoIndiceDoVetor,
            $quantidadeDeRegistrosNoDB,
            $quantidadesDeRegistrosParaMostrar){

                $this->apartirDoIndiceDoVetor = $apartirDoIndiceDoVetor;
                $this->quantidadeDeRegistrosNoDB = $quantidadeDeRegistrosNoDB;
                $this->quantidadesDeRegistrosParaMostrar = $quantidadesDeRegistrosParaMostrar;

                
                $this->numeroDePaginas = 
                    $this->quantidadeDeRegistrosNoDB / 
                    $this->quantidadesDeRegistrosParaMostrar;

                if(is_float($this->numeroDePaginas)){
                    $this->numeroDePaginas =  ((int) $this->numeroDePaginas) + 1;
                }

                $this->ultimaPaginaParaExibir();
                $this->primeiraPaginaParaExibir();
        }

        private function ultimaPaginaParaExibir(){
                $this->ultimaPagina =
                    ($this->apartirDoIndiceDoVetor + 5) > $this->numeroDePaginas 
                        ? ((int) $this->numeroDePaginas) 
                        : ($this->apartirDoIndiceDoVetor + 5);
        }

        private function primeiraPaginaParaExibir(){
            
            $this->inicio = $this->ultimaPagina -5 -4;

            if($this->inicio < 0){
                $this->inicio = 0;
            }
        }

        public function __get($value) {
		    return $this->$value;
	    }        

    }

?>