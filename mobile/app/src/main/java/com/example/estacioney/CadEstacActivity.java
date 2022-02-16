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

public class CadEstacActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cad_estac);

        final String login = Config.getLogin(CadEstacActivity.this);
        final String password = Config.getPassword(CadEstacActivity.this);

        Button btnCadEstac = findViewById(R.id.btnCadEstac);
        btnCadEstac.setOnClickListener(v -> {
            EditText etNomEstac = findViewById(R.id.etNomEstac);
            final String nomEstac = etNomEstac.getText().toString();
            if(nomEstac.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo Nome do Estacionamento não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etQtdVagas = findViewById(R.id.etQtdVagas);
            final String qtdVagas = etQtdVagas.getText().toString();
            if(qtdVagas.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo Qtd de Vagas não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etValFixo = findViewById(R.id.etValFixo);
            final String valFixo = etValFixo.getText().toString();
            if(valFixo.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo Valor Fixo não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etValAcresc = findViewById(R.id.etValAcresc);
            final String valAcresc = etValAcresc.getText().toString();
            if(valAcresc.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo acrescimo/hora não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etCep = findViewById(R.id.etCep);
            final String cep = etCep.getText().toString();
            if(cep.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo cep não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etRua = findViewById(R.id.etRua);
            final String rua = etRua.getText().toString();
            if(rua.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo rua não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etNum = findViewById(R.id.etNum);
            final String num = etNum.getText().toString();
            if(num.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo número não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etBairro = findViewById(R.id.etBairro);
            final String bairro = etBairro.getText().toString();
            if(bairro.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo bairro não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etCidade = findViewById(R.id.etCidade);
            final String cidade = etCidade.getText().toString();
            if(cidade.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo cidade não preenchido", Toast.LENGTH_LONG).show();
                return;
            }

            EditText etEstado = findViewById(R.id.etEstado);
            final String estado = etEstado.getText().toString();
            if(estado.isEmpty()) {
                Toast.makeText(CadEstacActivity.this, "Campo estado não preenchido", Toast.LENGTH_LONG).show();
                return;
            }


            ExecutorService executorService = Executors.newSingleThreadExecutor();
            executorService.execute(() -> {
                HttpRequest httpRequest = new HttpRequest(Config.SERVER_URL_BASE + "cadEstac.php", "POST", "UTF-8");
                httpRequest.setBasicAuth(login, password);

                httpRequest.addParam("nomEstac", nomEstac);
                httpRequest.addParam("qtdVagas", qtdVagas);
                httpRequest.addParam("valFixo", valFixo);
                httpRequest.addParam("valAcresc", valAcresc);
                httpRequest.addParam("cep", cep);
                httpRequest.addParam("rua", rua);
                httpRequest.addParam("num", num);
                httpRequest.addParam("bairro", bairro);
                httpRequest.addParam("cidade", cidade);
                httpRequest.addParam("estado", estado);

                try {
                    InputStream is = httpRequest.execute();
                    String result = Util.inputStream2String(is, "UTF-8");

                    JSONObject jsonObject = new JSONObject(result);
                    final int success = jsonObject.getInt("success");
                    if(success == 1) {
                        runOnUiThread(() -> {
                            // codigo
                            Intent i = new Intent(CadEstacActivity.this, ListaEstacActivity.class);
                            startActivity(i);
                            finish();
                        });
                    } else {
                        final String error = jsonObject.getString("error");
                        runOnUiThread(() -> Toast.makeText(CadEstacActivity.this, error, Toast.LENGTH_LONG).show());
                    }
                } catch (IOException | JSONException e) {
                    e.printStackTrace();
                }
            });
        });



    }


}