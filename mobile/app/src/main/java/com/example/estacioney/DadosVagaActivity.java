package com.example.estacioney;

import androidx.appcompat.app.AppCompatActivity;


import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class DadosVagaActivity extends AppCompatActivity {
    String idAlocado;
    String nomCliente;
    String placa;
    String hrEntrada;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dados_vaga);

        Intent i = getIntent();
        idAlocado = i.getStringExtra("idAlocado");
        nomCliente = i.getStringExtra("nomCliente");
        placa = i.getStringExtra("placa");
        hrEntrada = i.getStringExtra("hrEntrada");

        final String login = Config.getLogin(DadosVagaActivity.this);
        final String password = Config.getPassword(DadosVagaActivity.this);

        TextView tvNomCliente = findViewById(R.id.tvNomCliente2);
        tvNomCliente.setText(nomCliente);

        TextView tvPlaca = findViewById(R.id.tvPlaca2);
        tvPlaca.setText(placa);

        TextView tvHrEntrada = findViewById(R.id.tvHrEntrada2);
        tvHrEntrada.setText(hrEntrada);


        Button btnLiberar = findViewById(R.id.btnLiberar);
        btnLiberar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // liberar vaga
                ExecutorService executorService = Executors.newSingleThreadExecutor();
                executorService.execute(() -> {
                    HttpRequest httpRequest = new HttpRequest(Config.SERVER_URL_BASE + "liberar.php", "POST", "UTF-8");
                    httpRequest.setBasicAuth(login, password);

                    httpRequest.addParam("idAlocado", idAlocado);

                    try {
                        InputStream is = httpRequest.execute();
                        String result = Util.inputStream2String(is, "UTF-8");
                        httpRequest.finish();

                        Log.d("HTTP_REQUEST_RESULT", result);

                        JSONObject jsonObject = new JSONObject(result);
                        final int success = jsonObject.getInt("success");
                        if(success == 1) {
                            runOnUiThread(() -> {
                                // codigo
                                Intent i = new Intent(DadosVagaActivity.this, EstacActivity.class);
                                startActivity(i);
                                finish();
                            });
                        } else {
                            final String error = jsonObject.getString("error");
                            runOnUiThread(() -> Toast.makeText(DadosVagaActivity.this, error, Toast.LENGTH_LONG).show());
                        }
                    } catch (IOException | JSONException e) {
                        e.printStackTrace();
                    }

                });
            }
        });

    }
}