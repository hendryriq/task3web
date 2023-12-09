//query builder
        // $student=DB::table('students')->get();
        // dd($student);

        //elequent
        // $student = Student::all();
        // dd($student);

        //create data query builder
        // DB::table('students')->insert([
        //     'name' => 'query builder',
        //     'gender' => 'L',
        //     'nis' => '002333',
        //     'class_id' => 1
        // ]);

        //create data elequent
        // Student::create([
        //     'name' => 'data by elequent',
        //     'gender' => 'L',
        //     'nis' => '002333',
        //     'class_id' => 1
        // ]);

        //update data query builder
        // DB::table('students')->where('id', 28)->update([
        //     'name' => 'query builder 2',
        //     'class_id' => 3
        // ]);

        //update data elequent
        // Student::find(29)->update([
        //     'name' => 'elequent edit',
        //     'class_id' => 1,
        // ]);

        //delete data query builder
        // DB::table('students')->where('id', 27)->delete();

        // Student::find(28)->delete();

        // $nilai = [9, 2, 5, 6, 8, 5, 4, 23, 34, 5, 75, 4, 2];

        //php biasa
        // $countNilai = count($nilai);
        // $totalNilai = array_sum($nilai);
        // $nilaiRataRata = $totalNilai/$countNilai;

        //collection
        // $nilaiRataRata= collect($nilai)->avg();

        //containts
        // $contain = collect($nilai)->contains(function ($value) {
        //     return $value < 6;
        // });

        //diff
        // $restaurantA = ['burger', 'siomay', 'pizza', 'spagetti', 'makaroni', 'martabak', 'bakso'];
        // $restaurantB = ['pizza', 'fried chicken', 'sayur asem', 'martabak', 'pecel lele', 'bakso'];

        // $menuRestoA = collect($restaurantA)->diff($restaurantB);

        // dd($menuRestoA);

        //filter
        // $nilai = [9,8,7,6,4,8,9,1,10,3,9,7,1,5,3,9];

        // $aaa = collect($nilai)->filter(function ($value){
        //     return $value <7;
        // })->all();

        // dd($aaa);