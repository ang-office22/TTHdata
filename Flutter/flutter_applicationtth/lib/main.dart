import 'package:flutter/material.dart';

void main() {
  runApp(const MainApp());
}

class MainApp extends StatelessWidget {
  const MainApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        body: SafeArea(
          child: Padding(
            padding: const EdgeInsets.all(8.0),
            child: Column(
              children: [
                Center(child: Text('Customer Data', style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),)),
                SizedBox(height: 12,),

                // test kotak data
                Container(
                  width: double.infinity,
                  decoration: BoxDecoration(
                    border: Border.all(),
                  ),
                  child: Row(
                    children: [
                      Expanded(
                        flex: 1,
                        child: Icon(Icons.person_2)),
                      Expanded(
                        flex: 5,
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text('CustID001', style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold ),),
                            Text('Nama', style: TextStyle(fontSize: 16,)),
                            Text('Alamat', style: TextStyle(fontSize: 16,)),
                            Text('+62xxxxxxx02', style: TextStyle(fontSize: 16,)),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
