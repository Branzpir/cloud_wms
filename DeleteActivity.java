package com.example.kondawms;

import android.content.ClipData;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;


public class DeleteActivity extends MainActivity {
    private RecyclerView recyclerView;
    private ItemAdapter itemAdapter;
    private List<Items> itemsList;
    private static final String DATA_URL = "http://192.168.0.79/select.php?id=";
    private static final String KEY_ITEM = "item";
    private static final String KEY_LOCATION = "location";
    private static final String KEY_TIME = "time";
    private static final String JSON_ARRAY = "result";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_item_list);

        recyclerView = findViewById(R.id.recyclerList);
        recyclerView.setHasFixedSize(true);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        itemsList = new ArrayList<>();

        LoadAllItems();
    }

    private void LoadAllItems() {
        JsonArrayRequest request = new JsonArrayRequest(DATA_URL, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray array) {
                for(int i=0;i<array.length();i++)
                {
                    JSONObject object = null;
                    try {
                        object = array.getJSONObject(i);
                        String item = object.getString("item").trim();
                        String location = object.getString("location").trim();
                        String time = object.getString("time").trim();

                        Items items = new Items();
                        items.setItem(item);
                        items.setLocation(location);
                        items.setTime(time);
                        itemsList.add(items);

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }
                itemAdapter = new ItemAdapter(DeleteActivity.this,itemsList);
                recyclerView.setAdapter(itemAdapter);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(DeleteActivity.this, error.toString(), Toast.LENGTH_SHORT).show();
            }
        });
        RequestQueue requestQueue = Volley.newRequestQueue(DeleteActivity.this);
        requestQueue.add(request);
    }


}
