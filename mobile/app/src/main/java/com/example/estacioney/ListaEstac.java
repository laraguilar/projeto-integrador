package com.example.estacioney;

public class ListaEstac {
    String nomEstac;
    String endEstac;

    public ListaEstac(String nomEstac, String endEstac) {
        this.nomEstac = nomEstac;
        this.endEstac = endEstac;
    }

    public String getNomEstac() {
        return nomEstac;
    }

    public String getEndEstac() {
        return endEstac;
    }
}
