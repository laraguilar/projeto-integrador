package com.example.estacioney;

import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProvider;

import android.os.Bundle;
import android.widget.TextView;

public class EmpresaActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_empresa);

        final String login = Config.getLogin(EmpresaActivity.this);
        final String password = Config.getPassword(EmpresaActivity.this);

        EmpresaViewModel empresaViewModel = new ViewModelProvider(this).get(EmpresaViewModel.class);
        LiveData<Empresa> empr = empresaViewModel.getEmpresa();
        empr.observe(this, new Observer<Empresa>() {
            @Override
            public void onChanged(Empresa empresa) {
                TextView tvnomEmpresa = findViewById(R.id.tvNomEmpr);
                tvnomEmpresa.setText(empresa.getNomEmpresa());

                TextView tvEmail = findViewById(R.id.tvEmail);
                tvEmail.setText(empresa.getEmail());

                TextView tvTel = findViewById(R.id.tvTel);
                tvTel.setText(empresa.getTelefone());

                TextView tvCnpj = findViewById(R.id.tvCnpj);
                tvCnpj.setText(empresa.getCpfCnpj());
            }
        });

    }
}