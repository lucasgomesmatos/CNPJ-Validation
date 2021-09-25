<?php

namespace App\Validation;

class CNPJ
{

  /**
   * Método responsável por verificar se um CNPJ é valido
   *
   * @param String $cnpj
   * @return boolean
   */

  /** 
   * echo '<pre>';
    print_r($cnpj);
    echo '</pre>';
   */
  public static function validar($cnpj)
  {
    // OBTÉM OS NÚMEROS DO CNPJ

    $cnpj = preg_replace('/\D/', '', $cnpj);

    //VERIFICA A QUANTIDADE DE CARACTERES
    if (strlen($cnpj) != 14) {
      return false;
    }

    // DÍGITO VERIFICADOR

    $cnpjValidacao = substr($cnpj, 0, 12);
    $cnpjValidacao .= self::calcularDigitoVerificador($cnpjValidacao);
    $cnpjValidacao .= self::calcularDigitoVerificador($cnpjValidacao);

    //COMPARA O CNPJ ENVIADO COM O CNPJ CALCULADO



    return $cnpjValidacao == $cnpj;
  }

  /**
   * Método responsável por calcular um dígito verificador com base em uma sequência numérica
   *
   * @param String $base
   * @return String
   */
  public static function calcularDigitoVerificador($base)
  {
    /*
      -> CNPJ = 17.590.908/0001-03 
      -> Pega os 12 primeiros dígitos = 17.590.908/0001
      
      1x6 7x7 5x8 9x9 0x2 9x3 0x4 8x5 0x6 0x7 0x8 1x9
     */

     //AUXILARES

     $tamanho = strlen($base);
     $multiplicador = 9;

     //SOMA DAS MULTIPLICAÇÕES
     $soma = 0;

     //ITERA TODOS OS NÚMEROS DA BASE (DIREITA -> ESQUERDA)
     for($i = ($tamanho - 1); $i >= 0; $i-- ){
       //SOMA DA MULTIPLICAÇÃO ATUAL
      $soma += $base[$i] * $multiplicador;

      // AJUSTA O MULTIPLICADOR
      $multiplicador--;
      $multiplicador = $multiplicador < 2 ? 9 : $multiplicador;
     }

     echo $soma . '  ';

     // RESTO DA DIVISÃO = DÍGITO VERIFICADOR
     return $soma % 11;
  }
}
