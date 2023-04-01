<?php

    class OpcoesCidade
    {

        public function cidade($cidades)
        {
            $options = $this->selectCabecalho();

            foreach($cidades as $key => $value)
            {
                $options .= $this->selectLinha($key,$value);
            }
            return $options;
        }

        private function selectCabecalho()
        {
            return "<option>Selecione uma cidade</option>";
        }

        private function selectLinha($key,$value)
        {
            return "<option value='{$key}'>{$value}</option>";
        }

    }
?>