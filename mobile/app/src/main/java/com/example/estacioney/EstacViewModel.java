package com.example.estacioney;

import android.app.Application;
import android.util.Log;

import androidx.annotation.NonNull;
import androidx.lifecycle.AndroidViewModel;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;
import androidx.lifecycle.ViewModel;
import androidx.lifecycle.ViewModelProvider;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class EstacViewModel extends AndroidViewModel {
    MutableLiveData<Estacionamento> estacionamento;
    MutableLiveData<List<Alocado>> listAlocado;
    String idEstac;

    public EstacViewModel(@NonNull Application application, String idEstac) {
        super(application);
        this.idEstac = idEstac;
    }

    public LiveData<Estacionamento> getEstacionamento(){
        if(this.estacionamento == null){
            estacionamento = new MutableLiveData<Estacionamento>();
            loadEstacionamento();
        }
        return estacionamento;
    }

    public LiveData<List<Alocado>> getAlocado(){
        if(this.listAlocado == null){
            listAlocado = new MutableLiveData<List<Alocado>>();
            loadAlocado();
        }
        return listAlocado;
    }

    void refreshAlocados(){
        loadAlocado();
    }

    void loadEstacionamento(){
        final String login = Config.getLogin(getApplication());
        final String password = Config.getPassword(getApplication());
        //String idEstac = Config.getIdEstac(getApplication());

        ExecutorService executorService = Executors.newSingleThreadExecutor();
        executorService.execute(new Runnable() {
            @Override
            public void run() {
                HttpRequest httpRequest = new HttpRequest(Config.SERVER_URL_BASE + "estacHome.php", "POST", "UTF-8");
                httpRequest.setBasicAuth(login, password);
                httpRequest.addParam("idEstac", idEstac);

                try {
                    InputStream is = httpRequest.execute(); // morre aqui
                    String result = Util.inputStream2String(is, "UTF-8");
                    httpRequest.finish();

                    Log.d("HTTP_REQUEST_RESULT", result);

                    JSONObject jsonObject = new JSONObject(result);
                    int success = jsonObject.getInt("success");

                    if(success == 1) {
                        JSONArray jsonArray =  jsonObject.getJSONArray("dadosEstac");
                        JSONObject jProduct = jsonArray.getJSONObject(0);

                        String nomEstac = jProduct.getString("nomEstac");
                        String qtdVagas = jProduct.getString("qtdVagas");
                        String valFixo = jProduct.getString("valFixo");
                        String valAcresc = jProduct.getString("valAcresc");
                        String vagasDisp = jProduct.getString("vagasDisp");

                        Estacionamento e = new Estacionamento(idEstac, nomEstac, qtdVagas, valFixo, valAcresc, vagasDisp);



                        estacionamento.postValue(e);

                    }
                } catch (IOException | JSONException e) {
                    e.printStackTrace();
                }
            }
        });
    }

    void loadAlocado() {
        final String login = Config.getLogin(getApplication());
        final String password = Config.getPassword(getApplication());
        //String idEstac = Config.getIdEstac(getApplication());

        ExecutorService executorService = Executors.newSingleThreadExecutor();
        executorService.execute(new Runnable() {
            @Override
            public void run() {
                List<Alocado> alocaList = new ArrayList<>();

                HttpRequest httpRequest = new HttpRequest(Config.SERVER_URL_BASE + "listAlocados.php", "POST", "UTF-8");
                httpRequest.setBasicAuth(login, password);
                httpRequest.addParam("idEstac", idEstac);

                try {
                    InputStream is = httpRequest.execute(); // morre aqui
                    String result = Util.inputStream2String(is, "UTF-8");
                    httpRequest.finish();

                    Log.d("HTTP_REQUEST_RESULT", result);

                    JSONObject jsonObject = new JSONObject(result);
                    int success = jsonObject.getInt("success");

                    if (success == 1) {
                        JSONArray jsonArray = jsonObject.getJSONArray("alocados");


                        for (int i = 0; i < jsonArray.length(); i++) {
                            JSONObject jEstac = jsonArray.getJSONObject(i);

                            String idAloca = jEstac.getString("idAloca");
                            String idVaga = jEstac.getString("idVaga");
                            String nomCliente = jEstac.getString("nomCliente");
                            String cpfCliente = jEstac.getString("cpfCliente");
                            String hrEntrada = jEstac.getString("hrEntrada");
                            String dscPlaca = jEstac.getString("dscPlaca");

                            // cria um produto
                            Alocado alocado = new Alocado(idAloca, idVaga, nomCliente, cpfCliente, hrEntrada, dscPlaca);

                            alocaList.add(alocado);
                        }

                        listAlocado.postValue(alocaList);
                    }
                } catch (IOException | JSONException e) {
                    e.printStackTrace();
                }
            }
        });
    }

    // obriga a passar parametros no construtor do view model
    static public class EstacViewModelFactory implements ViewModelProvider.Factory{
        String idEstac;
        Application application;

        public EstacViewModelFactory(Application application, String idEstac) {
            this.idEstac = idEstac;
            this.application = application;
        }

        @NonNull
        @Override
        public <T extends ViewModel> T create(@NonNull Class<T> modelClass) {
            return (T) new EstacViewModel(application, idEstac);
        }
    }

}
