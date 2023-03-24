<?php

    class Botao{

        private $linkPincipal;

        private $ultimaPagina;
        private $inicio;
        private $apartirDoIndiceDoVetor;
        private $quantidadesDeRegistrosParaMostrar;
        private $quantidadeDeRegistrosNoDB;

        public function __construct($linkPincipal){
            $this->linkPincipal = $linkPincipal;
        }

        private function contarNumeroDePaginas(
            $apartirDoIndiceDoVetor,
            $quantidadeDeRegistrosNoDB,
            $quantidadesDeRegistrosParaMostrar){

                $this->apartirDoIndiceDoVetor = $apartirDoIndiceDoVetor;
                $this->quantidadeDeRegistrosNoDB = $quantidadeDeRegistrosNoDB;
                $this->quantidadesDeRegistrosParaMostrar = $quantidadesDeRegistrosParaMostrar;
        }

        private function numeroDePaginas(){
            $numeroDePaginas = 
                    $this->quantidadeDeRegistrosNoDB / 
                    $this->quantidadesDeRegistrosParaMostrar;

            if(is_float($numeroDePaginas)){
                $numeroDePaginas =  ((int) $numeroDePaginas) + 1;
            }
            return $numeroDePaginas;
        }

        private function ultimaPaginaParaExibir(){
            return 
            $this->primeiraPaginaParaExibir() == 1
                ? ((($this->primeiraPaginaParaExibir() + 4) >= $this->numeroDePaginas())
                    ? $this->numeroDePaginas()
                    : 4)
                : ((($this->primeiraPaginaParaExibir() + 4) >= $this->numeroDePaginas())
                    ? $this->apartirDoIndiceDoVetor
                    : $this->primeiraPaginaParaExibir() + 4);

                
        }

        private function primeiraPaginaParaExibir(){

            return
            ($this->apartirDoIndiceDoVetor - 2) < 1
                ? 1
                : ($this->apartirDoIndiceDoVetor - 2);
        }



        public function paginar($indiceInicial, $quantidade, $mostrar){

            $this->contarNumeroDePaginas($indiceInicial, $quantidade, $mostrar);

            return 
                "
                <nav aria-label='Page navigation'>
                    <ul class='pagination'>
                        <li>
                            <a class='btn btn-primary' href='" . base_url() . "index.php/{$this->linkPincipal}/listar/1' aria-label='Previous'>
                                <span aria-hidden='true'>&laquo;</span>
                            </a>
                        </li> 
                        ". $this->linkDoBatao() ." 
                        <li>
                            <a class='btn btn-primary' href='" . base_url() . "index.php/{$this->linkPincipal}/listar/" . ($this->numeroDePaginas() ) ."' aria-label='Next'>
                                <span aria-hidden='true'>&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                ";

        }




        private function linkDoBatao(){

            $li="";

            for($index = $this->primeiraPaginaParaExibir() ; $index <= $this->ultimaPaginaParaExibir() ; $index++){

                $disabled = ($index == ($this->apartirDoIndiceDoVetor+1)) ? 'disabled' : '';

                $li .= " <li>
                    <a class='btn btn-primary {$disabled}' 
                    href='" . base_url() . "index.php/{$this->linkPincipal}/listar/{$index}'>" . ($index ) . "</a></li> ";

            }

            return $li;

        }



    }


?>