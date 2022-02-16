package com.example.estacioney.adapter;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.estacioney.Alocado;
import com.example.estacioney.DadosVagaActivity;
import com.example.estacioney.EmpresaActivity;
import com.example.estacioney.EstacActivity;
import com.example.estacioney.Estacionamento;
import com.example.estacioney.R;

import java.util.List;

public class AlocaMyAdapter extends RecyclerView.Adapter {
    Context context;
    List<Alocado> listaAlocado;

    public AlocaMyAdapter(Context context, List<Alocado> listaAlocado) {
        this.context = context;
        this.listaAlocado = listaAlocado;
    }

    @NonNull
    @Override
    public RecyclerView.ViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(context);
        View v = inflater.inflate(R.layout.item_alocado, parent, false);
        MyViewHolder viewHolder = new MyViewHolder(v);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull RecyclerView.ViewHolder holder, int position) {
        Alocado listaAlocado = this.listaAlocado.get(position);

        TextView tvCliente = holder.itemView.findViewById(R.id.tvNomCliente);
        tvCliente.setText(listaAlocado.getNomCliente());

        TextView tvVaga = holder.itemView.findViewById(R.id.tvVaga);
        tvVaga.setText(listaAlocado.getIdVaga());

        TextView tvHrEntrada = holder.itemView.findViewById(R.id.tvHrEntrada);
        tvHrEntrada.setText(listaAlocado.getHrEntrada());

        TextView tvPlaca = holder.itemView.findViewById(R.id.tvPlaca);
        tvPlaca.setText(listaAlocado.getDscPlaca());

        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent i = new Intent(context, DadosVagaActivity.class); // colocar para ir pra activity ver vaga
                i.putExtra("idAlocado", listaAlocado.getIdAlocado());
                i.putExtra("nomCliente", listaAlocado.getNomCliente());
                i.putExtra("hrEntrada", listaAlocado.getHrEntrada());
                i.putExtra("placa", listaAlocado.getDscPlaca());
                context.startActivity(i);
            }
        });

    }

    @Override
    public int getItemCount() {
        return this.listaAlocado.size();
    }
}
