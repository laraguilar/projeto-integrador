package com.example.estacioney;

import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProvider;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;

import com.example.estacioney.adapter.AlocaMyAdapter;
import com.example.estacioney.adapter.MyAdapter;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.List;

public class EstacActivity extends AppCompatActivity {
    String idEstac;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_estac);

        Intent i = getIntent();
        idEstac = i.getStringExtra("idEstac");


        EstacViewModel estacViewModel = new ViewModelProvider(this, new EstacViewModel.EstacViewModelFactory(getApplication(), idEstac)).get(EstacViewModel.class);
        LiveData<Estacionamento> estacs = estacViewModel.getEstacionamento();
        estacs.observe(this, new Observer<Estacionamento>() {
            @Override
            public void onChanged(Estacionamento estacs) {
                TextView tvValFixo = findViewById(R.id.tvValFixo1);
                tvValFixo.setText(estacs.getValFixo());

                TextView tvValAcresc = findViewById(R.id.tvAcrescHr1);
                tvValAcresc.setText(estacs.getValAcresc());

                TextView tvDisp = findViewById(R.id.tvDisp);
                tvDisp.setText(estacs.getVagasDisp());
            }
        });


        RecyclerView rvAlocados = findViewById(R.id.rvAlocados);
        rvAlocados.setHasFixedSize(true);

        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this);
        rvAlocados.setLayoutManager(layoutManager);

        LiveData<List<Alocado>> listAlocados = estacViewModel.getAlocado();
        listAlocados.observe(this, new Observer<List<Alocado>>() {
            @Override
            public void onChanged(List<Alocado> alocados) {
                AlocaMyAdapter alocaMyAdapter = new AlocaMyAdapter(EstacActivity.this, alocados);
                rvAlocados.setAdapter(alocaMyAdapter);
            }
        });
        estacViewModel.refreshAlocados();


        ImageButton btnEmp = findViewById(R.id.btnEmp);
        btnEmp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(EstacActivity.this, EstacionamentoActivity.class);
                i.putExtra("idEstac", idEstac);
                startActivity(i);
            }
        });

        FloatingActionButton btnAddCar = findViewById(R.id.btn_add_cliente);
        btnAddCar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent j = new Intent(EstacActivity.this, EntradaActivity.class);
                j.putExtra("idEstac", idEstac);
                startActivity(j);
            }
        });


    }
}