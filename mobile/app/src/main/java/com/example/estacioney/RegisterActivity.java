package com.example.estacioney;

import androidx.appcompat.app.AppCompatActivity;

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

public class RegisterActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        Button btnRegister =  findViewById(R.id.btnRegister);
        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                EditText etNewEmail =  findViewById(R.id.etNewEmail);
                final String newEmail = etNewEmail.getText().toString();
                if(newEmail.isEmpty()) {
                    Toast.makeText(RegisterActivity.this, "Campo de email não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                EditText etNewnomEmpresa =  findViewById(R.id.etNewnomEmpresa);
                final String newNomEmpresa = etNewnomEmpresa.getText().toString();
                if(newNomEmpresa.isEmpty()) {
                    Toast.makeText(RegisterActivity.this, "Campo nome da empresa não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                EditText etNewPassword =  findViewById(R.id.etNewPassword);
                final String newPassword = etNewPassword.getText().toString();
                if(newPassword.isEmpty()) {
                    Toast.makeText(RegisterActivity.this, "Campo de senha não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                EditText etNewPasswordCheck =  findViewById(R.id.etNewPasswordCheck);
                String newPasswordCheck = etNewPasswordCheck.getText().toString();
                if(newPasswordCheck.isEmpty()) {
                    Toast.makeText(RegisterActivity.this, "Campo de checagem de senha não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                if(!newPassword.equals(newPasswordCheck)) {
                    Toast.makeText(RegisterActivity.this, "Senha não confere", Toast.LENGTH_LONG).show();
                    return;
                }

                EditText etNewTelefone =  findViewById(R.id.etNewTelefone);
                final String newTelefone = etNewTelefone.getText().toString();
                if(newTelefone.isEmpty()) {
                    Toast.makeText(RegisterActivity.this, "Campo de telefone não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }

                EditText etNewCpfCnpj =  findViewById(R.id.etNewCpfCnpj);
                final String newCpfCnpj = etNewCpfCnpj.getText().toString();
                if(newCpfCnpj.isEmpty()) {
                    Toast.makeText(RegisterActivity.this, "Campo de senha não preenchido", Toast.LENGTH_LONG).show();
                    return;
                }



                ExecutorService executorService = Executors.newSingleThreadExecutor();
                executorService.execute(new Runnable() {
                    @Override
                    public void run() {
                        HttpRequest httpRequest = new HttpRequest(Config.SERVER_URL_BASE + "cadEmpresa.php", "POST", "UTF-8");
                        httpRequest.addParam("newEmail", newEmail);
                        httpRequest.addParam("newPassword", newPassword);
                        httpRequest.addParam("newNomEmpresa", newNomEmpresa);
                        httpRequest.addParam("newTelefone", newTelefone);
                        httpRequest.addParam("newCpfCnpj", newCpfCnpj);

                        try {
                            InputStream is = httpRequest.execute();
                            String result = Util.inputStream2String(is, "UTF-8");
                            httpRequest.finish();

                            JSONObject jsonObject = new JSONObject(result);
                            final int success = jsonObject.getInt("success");
                            if(success == 1) {
                                runOnUiThread(new Runnable() {
                                    @Override
                                    public void run() {
                                        Toast.makeText(RegisterActivity.this, "Novo usuario registrado com sucesso", Toast.LENGTH_LONG).show();
                                        finish();
                                    }
                                });
                            }
                            else {
                                final String error = jsonObject.getString("error");
                                runOnUiThread(new Runnable() {
                                    @Override
                                    public void run() {
                                        Toast.makeText(RegisterActivity.this, error, Toast.LENGTH_LONG).show();
                                    }
                                });
                            }
                        } catch (IOException | JSONException e) {
                            e.printStackTrace();
                        }
                    }
                });
            }
        });
    }
}