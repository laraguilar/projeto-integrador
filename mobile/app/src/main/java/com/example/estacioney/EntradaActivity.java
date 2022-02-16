package com.example.estacioney;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;
import java.io.IOException;
import java.io.InputStream;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class EntradaActivity extends AppCompatActivity {
    String idEstac;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_entrada);

        Intent i = getIntent();
        idEstac = i.getStringExtra("idEstac");

        final String login = Config.getLogin(EntradaActivity.this);
        final String password = Config.getPassword(EntradaActivity.this);

        Button btnEntrada = findViewById(R.id.btnEntrada);
        btnEntrada.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                EditText etnomCliente = findViewById(R.id.nomCliente);
                final String nomCliente = etnomCliente.getText().toString();
                if(nomCliente.isEmpty()) {
                    Toast.makeText(EntradaActivity.this, "Campo Nome do Cliente não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                EditText etCpfCliente = findViewById(R.id.cpfCliente);
                final String cpfCliente = etCpfCliente.getText().toString();
                if(cpfCliente.isEmpty()) {
                    Toast.makeText(EntradaActivity.this, "Campo Cpf do Cliente não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                EditText etPlaca = findViewById(R.id.placa);
                final String placa = etPlaca.getText().toString();
                if(placa.isEmpty()) {
                    Toast.makeText(EntradaActivity.this, "Campo placa não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                EditText etVaga = findViewById(R.id.vaga);
                final String vaga = etVaga.getText().toString();
                if(vaga.isEmpty()) {
                    Toast.makeText(EntradaActivity.this, "Campo vaga não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                ExecutorService executorService = Executors.newSingleThreadExecutor();
                executorService.execute(() -> {
                    HttpRequest httpRequest = new HttpRequest(Config.SERVER_URL_BASE + "entrada.php", "POST", "UTF-8");
                    httpRequest.setBasicAuth(login, password);

                    httpRequest.addParam("idEstac", idEstac);
                    httpRequest.addParam("nomCliente", nomCliente);
                    httpRequest.addParam("cpfCliente", cpfCliente);
                    httpRequest.addParam("placa", placa);
                    httpRequest.addParam("vaga", vaga);

                    try {
                        InputStream is = httpRequest.execute();
                        String result = Util.inputStream2String(is, "UTF-8");

                        JSONObject jsonObject = new JSONObject(result);
                        final int success = jsonObject.getInt("success");
                        if(success == 1) {
                            runOnUiThread(() -> {
                                // codigo
                                Intent i = new Intent(EntradaActivity.this, EstacActivity.class);
                                startActivity(i);
                                finish();
                            });
                        } else {
                            final String error = jsonObject.getString("error");
                            runOnUiThread(() -> Toast.makeText(EntradaActivity.this, error, Toast.LENGTH_LONG).show());
                        }
                    } catch (IOException | JSONException e) {
                        e.printStackTrace();
                    }

                });
            }
        });
    }
}

