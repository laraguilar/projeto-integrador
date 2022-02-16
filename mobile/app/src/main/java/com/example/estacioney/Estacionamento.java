package com.example.estacioney;

public class Estacionamento {
    String idEstac;
    String nomEstac;
    String qtdVagas;
    String valFixo;
    String valAcresc;
    String vagasDisp;
    String logr;
    String cep;
    String num;
    String bairro;
    String cidade;
    String estado;


    public Estacionamento(String idEstac, String nomEstac, String qtdVagas, String valFixo, String valAcresc, String cep, String logr, String num, String bairro, String cidade, String estado) {
        this.idEstac = idEstac;
        this.nomEstac = nomEstac;
        this.qtdVagas = qtdVagas;
        this.valFixo = valFixo;
        this.valAcresc = valAcresc;
        this.vagasDisp = vagasDisp;
        this.cep = cep;
        this.logr = logr;
        this.bairro = bairro;
        this.cidade = cidade;
        this.estado = estado;
        this.num = num;
    }

    public Estacionamento(String idEstac, String nomEstac, String qtdVagas, String valFixo, String valAcresc, String vagasDisp) {
        this.idEstac = idEstac;
        this.nomEstac = nomEstac;
        this.qtdVagas = qtdVagas;
        this.valFixo = valFixo;
        this.valAcresc = valAcresc;
        this.vagasDisp = vagasDisp;
    }


    public Estacionamento(String idEstac, String nomEstac, String cep, String logr, String num) {
        this.idEstac = idEstac;
        this.nomEstac = nomEstac;
        this.cep = cep;
        this.logr = logr;
        this.num = num;
    }

    public String getIdEstac() {
        return idEstac;
    }

    public void setIdEstac(String idEstac) {
        this.idEstac = idEstac;
    }

    public String getNomEstac() {
        return nomEstac;
    }

    public void setNomEstac(String nomEstac) {
        this.nomEstac = nomEstac;
    }

    public String getLogr() {
        return logr;
    }

    public void setLogr(String logr) {
        this.logr = logr;
    }

    public String getCep() {
        return cep;
    }

    public void setCep(String cep) {
        this.cep = cep;
    }

    public String getQtdVagas() {
        return qtdVagas;
    }

    public void setQtdVagas(String qtdVagas) {
        this.qtdVagas = qtdVagas;
    }

    public String getValFixo() {
        return valFixo;
    }

    public void setValFixo(String valFixo) {
        this.valFixo = valFixo;
    }

    public String getValAcresc() {
        return valAcresc;
    }

    public void setValAcresc(String valAcresc) {
        this.valAcresc = valAcresc;
    }

    public String getVagasDisp() {
        return vagasDisp;
    }

    public void setVagasDisp(String vagasDisp) {
        this.vagasDisp = vagasDisp;
    }

    public String getNum() {
        return num;
    }

    public void setNum(String num) {
        this.num = num;
    }

    public String getBairro() {
        return bairro;
    }

    public void setBairro(String bairro) {
        this.bairro = bairro;
    }

    public String getCidade() {
        return cidade;
    }

    public void setCidade(String cidade) {
        this.cidade = cidade;
    }

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }



}
