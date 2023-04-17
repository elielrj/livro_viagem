<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class NivelDeAcesso{

        static $nivel_de_acesso = 'nivelDeAcesso';
        static $funcao = 'funcao';

        static $LER = "Ler";
        static $ESCREVER = "Escrever";
        static $DESPACHAR = "Despachar";
        static $ADMINISTRAR = "Administrar";
        static $ROOT = "Root";

        // Leitor
        public static function isReader(){

            if(!NivelDeAcesso::nivelDeAcessoEstaVazio()){
                if($_SESSION[self::$funcao][self::$nivel_de_acesso] == self::$LER){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }            
        }

        //Escritor
        public static function isWriter(){

            if(!NivelDeAcesso::nivelDeAcessoEstaVazio()){
                if($_SESSION[self::$funcao][self::$nivel_de_acesso] == self::$ESCREVER){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }            
        }

        //despachante
        public static function isDispatcher(){

            if(!NivelDeAcesso::nivelDeAcessoEstaVazio()){
                if($_SESSION[self::$funcao][self::$nivel_de_acesso] == self::$DESPACHAR){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }            
        }

        //administrador
        public static function isAdmin(){

            if(!NivelDeAcesso::nivelDeAcessoEstaVazio()){
                if($_SESSION[self::$funcao][self::$nivel_de_acesso] == self::$ADMINISTRAR){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }            
        }

        //super Usuário
        public static function isRoot(){

            if(!NivelDeAcesso::nivelDeAcessoEstaVazio()){
                if($_SESSION[self::$funcao][self::$nivel_de_acesso] == self::$ROOT){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }            
        }

        //verificar se existe sessão para nivel de acesso
        private static function nivelDeAcessoEstaVazio(){

            return empty($_SESSION[self::$funcao][self::$nivel_de_acesso]);
        }
    }
?>