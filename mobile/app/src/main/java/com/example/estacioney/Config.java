package com.example.estacioney;

import android.content.Context;
import android.content.SharedPreferences;

import com.example.estacioney.adapter.MyAdapter;

public class Config {

    static String SERVER_URL_BASE = "https://testestacioney.herokuapp.com/code/mobile/";

    public static void setLogin(Context context, String login) {
        SharedPreferences mPrefs = context.getSharedPreferences("configs", 0);
        SharedPreferences.Editor mEditor = mPrefs.edit();
        mEditor.putString("login", login).commit();
    }

    public static String getLogin(Context context) {
        SharedPreferences mPrefs = context.getSharedPreferences("configs", 0);
        return mPrefs.getString("login", "");
    }

    public static void setPassword(Context context, String password) {
        SharedPreferences mPrefs = context.getSharedPreferences("configs", 0);
        SharedPreferences.Editor mEditor = mPrefs.edit();
        mEditor.putString("password", password).commit();
    }

    public static String getPassword(Context context) {
        SharedPreferences mPrefs = context.getSharedPreferences("configs", 0);
        return mPrefs.getString("password", "");
    }

    public  static String getIdEstac(Context context){
        SharedPreferences mPrefs = context.getSharedPreferences("configs", 0);
        return mPrefs.getString("idEstac", "");
    }

    public static void setIdEstac(Context context, String idEstac) {
        SharedPreferences mPrefs = context.getSharedPreferences("configs", 0);
        SharedPreferences.Editor mEditor = mPrefs.edit();
        mEditor.putString("idEstac", idEstac).commit();
    }


}

