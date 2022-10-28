package com.example.kondawms;

import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.util.List;

public class ItemAdapter extends RecyclerView.Adapter<ItemAdapter.ItemHolder>{
    Context context;
    List<Items> itemsList;
    public ItemAdapter(Context context, List<Items> itemsList) {
        this.context = context;
        this.itemsList = itemsList;
    }

    @NonNull
    @Override
    public ItemAdapter.ItemHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemLayout = LayoutInflater.from(parent.getContext()).inflate(R.layout.activity_delete,parent, false);
        return new ItemHolder(itemLayout);
    }

    @Override
    public void onBindViewHolder(@NonNull ItemAdapter holder, int position) {
    Items items = itemsList.get(position);
    holder.Item.setText(items.getItem());
    holder.Location.setText(items.getLocation());
    holder.Time.setText(items.getTime());
    }

    @Override
    public int getItemCount() {
        return itemsList.size();
    }

    public class ItemHolder extends RecyclerView.ViewHolder {

    }
}
