package com.example.estacioney;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;
import androidx.lifecycle.LiveData;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProvider;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.estacioney.adapter.MyAdapter;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.time.Duration;
import java.util.List;

public class ListaEstacActivity extends AppCompatActivity {
    private Duration ViewModelProviders;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_lista_estac);

        final String login = Config.getLogin(ListaEstacActivity.this);
        final String password = Config.getPassword(ListaEstacActivity.this);

        RecyclerView rvListEstac = findViewById(R.id.rvListEstac);
        rvListEstac.setHasFixedSize(true);

        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this);
        rvListEstac.setLayoutManager(layoutManager);

        ListaEstacViewModel listaEstacViewModel = new ViewModelProvider(this).get(ListaEstacViewModel.class);
        LiveData<List<Estacionamento>> listEstacs = listaEstacViewModel.getListaEstacs();
        listEstacs.observe(this, new Observer<List<Estacionamento>>() {
            @Override
            public void onChanged(List<Estacionamento> listEstacs) {
                MyAdapter myAdapter = new MyAdapter(ListaEstacActivity.this, listEstacs);
                rvListEstac.setAdapter(myAdapter);
            }
        });

        listaEstacViewModel.refreshEstacs();

        Button btnLogout = findViewById(R.id.btnLogout);
        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Config.setLogin(ListaEstacActivity.this, "");
                Config.setPassword(ListaEstacActivity.this, "");
                Intent i = new Intent(ListaEstacActivity.this, LoginActivity.class);
                startActivity(i);
            }
        });

        FloatingActionButton btnAddEstac = findViewById(R.id.btnAddEstac);
        btnAddEstac.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent a = new Intent(ListaEstacActivity.this, CadEstacActivity.class);
                startActivity(a);
            }
        });

    }

}
