package com.example.estacioney;

public class Alocado {
    String idAlocado;
    String nomCliente;
    String idVaga;
    String hrEntrada;
    String hrSaida;
    String valTotal;
    String dscPlaca;
    String cpfCliente;


    public Alocado(String idAlocado, String idVaga, String nomCliente, String cpfCliente, String hrEntrada, String dscPlaca) {
        this.idAlocado = idAlocado;
        this.nomCliente = nomCliente;
        this.idVaga = idVaga;
        this.hrEntrada = hrEntrada;
        this.dscPlaca = dscPlaca;
        this.cpfCliente = cpfCliente;
    }

    public String getNomCliente() {
        return nomCliente;
    }

    public void setNomCliente(String nomCliente) {
        this.nomCliente = nomCliente;
    }

    public String getIdAlocado() {
        return idAlocado;
    }

    public void setIdAlocado(String idAlocado) {
        this.idAlocado = idAlocado;
    }

    public String getIdVaga() {
        return idVaga;
    }

    public void setIdVaga(String idVaga) {
        this.idVaga = idVaga;
    }

    public String getHrEntrada() {
        return hrEntrada;
    }

    public void setHrEntrada(String hrEntrada) {
        this.hrEntrada = hrEntrada;
    }

    public String getHrSaida() {
        return hrSaida;
    }

    public void setHrSaida(String hrSaida) {
        this.hrSaida = hrSaida;
    }

    public String getValTotal() {
        return valTotal;
    }

    public void setValTotal(String valTotal) {
        this.valTotal = valTotal;
    }

    public String getDscPlaca() {
        return dscPlaca;
    }

    public void setDscPlaca(String dscPlaca) {
        this.dscPlaca = dscPlaca;
    }

    public String getCpfCliente() {
        return cpfCliente;
    }

    public void setCpfCliente(String cpfCliente) {
        this.cpfCliente = cpfCliente;
    }


}
