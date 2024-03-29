package com.example.kondawms;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class DeleteActivity extends MainActivity implements View.OnClickListener{
    EditText bin_location_input;
    Button btn;
    TextView textViewResult;
    ProgressDialog loading;
    private static final String DATA_URL = "http://192.168.0.79/select.php?id=";
    private static final String KEY_ITEM = "item";
    private static final String KEY_LOCATION = "location";
    private static final String KEY_TIME = "time";
    private static final String JSON_ARRAY = "result";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_delete);

        bin_location_input=(EditText)findViewById(R.id.bin_location_input);
        btn=(Button)findViewById(R.id.button_id3);
        textViewResult=(TextView) findViewById(R.id.cardView);
        final Button button = findViewById(R.id.delete_back_id);
        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(v.getContext(), MainActivity.class);
                startActivity(intent);
            }
        });

        btn.setOnClickListener(this);
    }

    private void getData() {
        String id = bin_location_input.getText().toString().trim();
        if(id.equals("")) {
            Toast.makeText(this, "Scan Bin Location", Toast.LENGTH_LONG).show();
            return;
        }
        loading = ProgressDialog.show(this, "Please wait...", "Fetching...",false,false);
        String url = DATA_URL+bin_location_input.getText().toString().trim();

        StringRequest stringRequest = new StringRequest(url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                loading.dismiss();
                showJSON(response);
            }
        },
        new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(DeleteActivity.this, error.getMessage(),Toast.LENGTH_LONG).show();
            }
        });
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void showJSON(String response) {
        String item;
        String location;
        String time;
        try {
            JSONObject jsonObject = new JSONObject(response);
            JSONArray result = jsonObject.getJSONArray(JSON_ARRAY);
            StringBuilder output = new StringBuilder();
            for(int i=0;i<result.length();i++) {
                JSONObject itemData = result.getJSONObject(i);
                item = itemData.getString(KEY_ITEM);
                location = itemData.getString(KEY_LOCATION);
                time = itemData.getString(KEY_TIME);
                output.append(String.format("\nItem:\t%s\nLocation:\t%s\nTime:\t%s\n", item, location, time));
                // currently only works when there is more than 1 entry in a particular location
            }
            textViewResult.setText(output.toString());
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }
    @Override
    public void onClick(View v) {
        getData();
    }
}
