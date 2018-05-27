package com.chenyialone.voicewritet;

/**
 * 添加修改的活动页面
 * Created by chenyiAlone on 2018/5/20.
 */

import android.content.ClipboardManager;
import android.content.ContentValues;
import android.content.Context;
import android.content.Intent;
import android.database.sqlite.SQLiteDatabase;
import android.os.Handler;
import android.os.Message;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.MotionEvent;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.chenyialone.voicewritet.util.Listener;
import com.iflytek.cloud.SpeechConstant;
import com.iflytek.cloud.SpeechUtility;

public class AddActivity
        extends AppCompatActivity
        implements View.OnClickListener, View.OnTouchListener {

    private boolean isModify;
    private Integer id;
    private SQLiteDatabase db;

    private static EditText
        meditTextTittle,
        meditTextText,
        mprintedit;
    private TextView mtittle;
    //语音识别实例对象
    private static Listener mlistener;
    private static ImageButton
        stop,
        recording;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_add);
        SpeechUtility.createUtility(this, SpeechConstant.APPID +"=5addc52a");
        init();
    }

    /**
     * 成员初始化
     */
    private void init(){
        db = MainActivity.mdbHelper.getWritableDatabase();

        findViewById(R.id.toolbar_left_btn).setOnClickListener(this);
        findViewById(R.id.toolbar_right_btn).setOnClickListener(this);
        mtittle = (TextView)findViewById(R.id.toolbar_title_tv);

        recording = (ImageButton)findViewById(R.id.imageButton_recording);
        stop = (ImageButton)findViewById(R.id.imageButton_stop);

        recording.setOnClickListener(this);
        stop.setOnClickListener(this);

        meditTextTittle = (EditText)findViewById(R.id.editTittle);
        meditTextText = (EditText)findViewById(R.id.editText);

        meditTextTittle.setOnTouchListener(this);
        meditTextText.setOnTouchListener(this);

        mprintedit = meditTextTittle;
        mlistener = new Listener(this,meditTextText);

        Intent intent = getIntent();
        String tittle = intent.getStringExtra("tittle");

        //获取主键
        id = intent.getIntExtra("id",0);
        String text = intent.getStringExtra("text");
        //是否为修改的判断标识
        isModify = intent.getBooleanExtra("isModify",false);

        if(!"".equals(tittle)&&tittle!=null){
            mtittle.setText(tittle);
            meditTextTittle.setText(tittle);
        } else {
            mtittle.setText("无标题");
        }
        if(!"".equals(text)&&text!=null){
            meditTextText.setText(text);
        }
    }

    public static Handler mHandler = new Handler(){
        @Override
        public void handleMessage(Message msg) {
            super.handleMessage(msg);
            switch (msg.what) {
                case 0:
                    //将识别的文本输入到EditText
                    mprintedit.setText(msg.obj.toString());
                    //do something,refresh UI;

                    break;
                case 1:
                    //语音到达识别节点的时候调用更改语音识别按钮
                    mlistener.stopListen();
                    stop.setVisibility(View.GONE);
                    recording.setVisibility(View.VISIBLE);

                    break;
                default:
                    break;
            }
        }
    };

    @Override
    public void onClick(View v) {
        switch(v.getId()) {
            case R.id.toolbar_left_btn:
                mprintedit.setText("");
                break;
            case R.id.toolbar_right_btn:
                ClipboardManager cm = (ClipboardManager) getSystemService(Context.CLIPBOARD_SERVICE);
                // 将文本内容放到系统剪贴板里。
                cm.setText(meditTextText.getText().toString());
                Toast.makeText(this, "复制成功", Toast.LENGTH_SHORT).show();
            case R.id.imageButton_stop:
                mlistener.stopListen();
                stop.setVisibility(View.GONE);
                recording.setVisibility(View.VISIBLE);
                break;
            case R.id.imageButton_recording:
                mlistener.listen();
                recording.setVisibility(View.GONE);
                stop.setVisibility(View.VISIBLE);
                break;
            default:
                break;
        }
    }

    /**
     * 触摸监听对象，用来切换正在输入的EditText
     * @param v
     * @param event
     * @return
     */
    @Override
    public boolean onTouch(View v, MotionEvent event) {
            switch(v.getId()) {
                case R.id.editText:
                    mprintedit = meditTextText;
                    mlistener.setEditText(meditTextText);
                    break;
                case R.id.editTittle:
                    mprintedit = meditTextTittle;
                    mlistener.setEditText(meditTextTittle);
                    break;
            }
        return false;
    }

    @Override
    public void onBackPressed() {

        if(!"".equals(meditTextTittle.getText().toString())
                ||!"".equals(meditTextText.getText().toString())
                &&meditTextTittle.getText().toString()!=null
                &&meditTextText.getText().toString()!=null){
            ContentValues contentValues = new ContentValues();

            if(isModify){
                contentValues.put("tittle",meditTextTittle.getText().toString());
                contentValues.put("text",meditTextText.getText().toString());
                db.update("Txt",contentValues,"id = ?",new String[]{id.toString()});
                contentValues.clear();
            }else {
                contentValues.put("tittle",meditTextTittle.getText().toString());
                contentValues.put("text",meditTextText.getText().toString());
                db.insert("Txt",null,contentValues);
                contentValues.clear();
            }
        }else {
            db.delete("Txt","id = ?",new String[]{id.toString()});
        }

        Intent intent = new Intent(this,MainActivity.class);
        setResult(RESULT_OK,intent);
        startActivityForResult(intent,RESULT_OK);
        finish();
    }
}
