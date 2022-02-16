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
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class EmpresaViewModel extends AndroidViewModel {
    MutableLiveData<Empresa> empresa;

    public EmpresaViewModel(@NonNull Application application) {
        super(application);
    }

    public LiveData<Empresa> getEmpresa(){
        if(this.empresa == null){
            empresa = new MutableLiveData<Empresa>();
            loadEmpresa();
        }
        return empresa;
    }

    private void loadEmpresa() {
        final String login = Config.getLogin(getApplication());
        final String password = Config.getPassword(getApplication());

        ExecutorService executorService = Executors.newSingleThreadExecutor();
        executorService.execute(new Runnable() {
            @Override
            public void run() {
                HttpRequest httpRequest = new HttpRequest(Config.SERVER_URL_BASE + "dadosEmpresa.php", "POST", "UTF-8");
                httpRequest.setBasicAuth(login, password);


                try {
                    InputStream is = httpRequest.execute(); // morre aqui
                    String result = Util.inputStream2String(is, "UTF-8");
                    httpRequest.finish();

                    Log.d("HTTP_REQUEST_RESULT", result);

                    JSONObject jsonObject = new JSONObject(result);
                    int success = jsonObject.getInt("success");

                    if(success == 1) {
                        JSONArray jsonArray =  jsonObject.getJSONArray("empresa");
                        JSONObject jProduct = jsonArray.getJSONObject(0);

                        String nomEmpresa = jProduct.getString("nomEmpresa");
                        String email = jProduct.getString("email");
                        String telefone = jProduct.getString("telefone");
                        String cpfCnpj = jProduct.getString("cpfCnpj");
                        String img = jProduct.getString("img");


                        Empresa e = new Empresa(nomEmpresa, email, cpfCnpj, telefone, img);

                        empresa.postValue(e);

                    }
                } catch (IOException | JSONException e) {
                    e.printStackTrace();
                }
            }
        });
    }

    void refreshEmpresa(){
        loadEmpresa();
    }

}
