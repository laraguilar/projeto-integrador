package com.example.estacioney;

import android.app.Application;
import android.util.Log;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class ListaEstacViewModel extends AndroidViewModel {
    MutableLiveData <List<Estacionamento>> listaEstacs;

    public ListaEstacViewModel(@NonNull Application application) {
        super(application);
    }

    public LiveData<List<Estacionamento>> getListaEstacs(){
        if(listaEstacs == null){
            listaEstacs = new MutableLiveData<List<Estacionamento>>();
            loadListaEstac();
        }
        return listaEstacs;
    }

    public void refreshEstacs(){
        loadListaEstac();
    }

    void loadListaEstac(){
        final String login = Config.getLogin(getApplication());
        final String password = Config.getPassword(getApplication());

        ExecutorService executorService = Executors.newSingleThreadExecutor();
        executorService.execute(new Runnable() {
            @Override
            public void run() {
                List<Estacionamento> estacList = new ArrayList<>();

                HttpRequest httpRequest = new HttpRequest(Config.SERVER_URL_BASE + "listEstac.php", "GET", "UTF-8");
                httpRequest.setBasicAuth(login, password);
                try {
                    InputStream is = httpRequest.execute();
                    String result = Util.inputStream2String(is, "UTF-8");
                    httpRequest.finish();

                    Log.d("HTTP_REQUEST_RESULT", result);

                    JSONObject jsonObject = new JSONObject(result);
                    final int success = jsonObject.getInt("success");

                    if(success == 1) {
                        JSONArray jsonArray =  jsonObject.getJSONArray("estacionamentos");



                        for (int i = 0; i<jsonArray.length(); i++){
                            JSONObject jEstac = jsonArray.getJSONObject(i);

                            String idEstac = jEstac.getString("idEstac");
                            String nomEstac = jEstac.getString("nomEstac");
                            String cep = jEstac.getString("cep");
                            String logr = jEstac.getString("logr");
                            String num = jEstac.getString("num");


                            // cria um produto
                            Estacionamento estacionamento = new Estacionamento(idEstac, nomEstac, cep, logr, num);

                            // adiciona o estacionamento na lista
                            estacList.add(estacionamento);

                        }
                        listaEstacs.postValue(estacList); // seta a nova lista de estacionamentos
                    }
                } catch (IOException | JSONException e) {
                    e.printStackTrace();
                }
            }
        });
    }
}
