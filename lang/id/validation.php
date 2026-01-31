<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'        => ':Attribute harus dapat diterima.',
    'accepted_if'     => ':Attribute harus dapat diterima saat :other berisi :value.',
    'active_url'      => ':Attribute bukan merupakan URL yang valid.',
    'after'           => ':Attribute harus merupakan tanggal setelah :date.',
    'after_or_equal'  => ':Attribute harus merupakan tanggal setelah atau sama dengan :date.',
    'alpha'           => ':Attribute harus berupa huruf.',
    'alpha_dash'      => ':Attribute harus berupa huruf, angka, strip dan garis bawah.',
    'alpha_num'       => ':Attribute harus berupa huruf dan angka.',
    'array'           => ':Attribute harus berupa daftar.',
    'before'          => ':Attribute harus merupakan tanggal sebelum :date.',
    'before_or_equal' => ':Attribute harus merupakan tanggal sebelum atau sama dengan :date.',
    'between'         => [
        'array'   => ':Attribute harus memiliki antara :min sampai :max item.',
        'file'    => ':Attribute harus berukuran :min sampai :max kilobyte.',
        'numeric' => ':Attribute harus berisi antara :min sampai :max.',
        'string'  => ':Attribute harus berisi antara :min sampai :max karakter.',
    ],
    'boolean'          => ':Attribute harus merupakan true atau false.',
    'confirmed'        => 'Konfirmasi :attribute tidak sesuai.',
    'current_password' => 'Kata sandi tidak sesuai.',
    'date'             => ':Attribute bukan merupakan tanggal yang valid.',
    'date_equals'      => ':Attribute harus merupakan tanggal :date.',
    'date_format'      => ':Attribute tidak sesuai dengan format berikut: :format.',
    'declined'         => ':Attribute harus ditolak.',
    'declined_if'      => ':Attribute harus ditolak saat :other berisi :value.',
    'different'        => ':Attribute dan :other tidak boleh sama.',
    'digits'           => ':Attribute harus berisi :digits angka.',
    'digits_between'   => ':Attribute harus memiliki antara :min sampai :max angka.',
    'dimensions'       => 'Dimensi :attribute tidak sesuai.',
    'distinct'         => 'Ada bidang lain yang isinya sama dengan :Attribute.',
    'email'            => ':Attribute harus merupakan alamat email yang valid.',
    'ends_with'        => ':Attribute harus diakhiri dengan salah satu dari: :values.',
    'enum'             => ':Attribute yang dipilih tidak valid.',
    'exists'           => ':Attribute yang dipilih tidak valid.',
    'file'             => ':Attribute harus merupakan file.',
    'filled'           => ':Attribute harus diisi.',
    'gt'               => [
        'array'   => ':Attribute harus punya lebih dari :value item.',
        'file'    => ':Attribute harus berukuran lebih dari :value kilobyte.',
        'numeric' => ':Attribute harus berisi lebih dari :value.',
        'string'  => ':Attribute harus berisi lebih dari :value karakter.',
    ],
    'gte' => [
        'array'   => ':Attribute harus punya lebih dari atau sama dengan :value item.',
        'file'    => ':Attribute harus berukuran lebih dari atau sama dengan :value kilobyte.',
        'numeric' => ':Attribute harus berisi lebih dari atau sama dengan :value.',
        'string'  => ':Attribute harus berisi lebih dari atau sama dengan :value karakter.',
    ],
    'image'     => ':Attribute harus merupakan gambar.',
    'in'        => 'Pilihan :attribute tidak valid.',
    'in_array'  => 'Pilihan :attribute tidak berada di :other.',
    'integer'   => ':Attribute harus merupakan bilangan bulat.',
    'ip'        => ':Attribute harus merupakan alamat IP yang valid.',
    'ipv4'      => ':Attribute harus merupakan alamat IPv4 yang valid.',
    'ipv6'      => ':Attribute harus merupakan alamat IPv6 yang valid.',
    'json'      => ':Attribute harus merupakan JSON string yang valid.',
    'lowercase' => ':Attribute harus merupakan huruf kecil.',
    'lt'        => [
        'array'   => ':Attribute harus punya kurang dari :value item.',
        'file'    => ':Attribute harus berukuran kurang dari :value kilobyte.',
        'numeric' => ':Attribute harus berisi kurang dari :value.',
        'string'  => ':Attribute harus berisi kurang dari :value karakter.',
    ],
    'lte' => [
        'array'   => ':Attribute harus punya kurang dari atau sama dengan :value item.',
        'file'    => ':Attribute harus berukuran kurang dari atau sama dengan :value kilobyte.',
        'numeric' => ':Attribute harus berisi kurang dari atau sama dengan :value.',
        'string'  => ':Attribute harus berisi kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => ':Attribute harus merupakan alaman MAC yang valid.',
    'max'         => [
        'array'   => ':Attribute tidak boleh memiliki lebih dari :max item.',
        'file'    => ':Attribute tidak boleh berukuran lebih dari :max kilobyte.',
        'numeric' => ':Attribute tidak boleh lebih dari :max.',
        'string'  => ':Attribute tidak boleh berisi lebih dari :max karakter.',
    ],
    'mimes'     => ':Attribute harus berekstensi: :values.',
    'mimetypes' => ':Attribute harus berekstensi: :values.',
    'min'       => [
        'array'   => ':Attribute harus setidaknya memiliki :min item.',
        'file'    => ':Attribute harus setidaknya berukuran :min kilobyte.',
        'numeric' => ':Attribute harus setidaknya berisi :min.',
        'string'  => ':Attribute harus setidaknya berisi :min karakter.',
    ],
    'multiple_of' => ':Attribute harus merupakan gandaan dari :value.',
    'not_in'      => 'Pilihan :attribute tidak valid.',
    'not_regex'   => 'Format :attribute tidak valid.',
    'numeric'     => ':Attribute harus berupa angka.',
    'password'    => [
        'letters'       => ':Attribute harus berisi setidaknya satu huruf.',
        'mixed'         => ':Attribute harus berisi setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers'       => ':Attribute harus berisi setidaknya satu angka.',
        'symbols'       => ':Attribute harus berisi setidaknya satu simbol.',
        'uncompromised' => ':Attribute tersebut merupakan :attribute yang mudah diretas. Silakan isi dengan :attribute yang lain.',
    ],
    'phone'                => ':Attribute harus merupakan nomor ponsel yang valid.',
    'phone_registered'     => ':Attribute harus merupakan nomor ponsel yang valid dan teregistrasi.',
    'present'              => ':Attribute harus ada.',
    'prohibited'           => ':Attribute tidak boleh diisi.',
    'prohibited_if'        => ':Attribute tidak boleh diisi saat :other berisi :value.',
    'prohibited_unless'    => ':Attribute tidak boleh diisi kecuali :other berisi :values.',
    'prohibits'            => 'Adanya :attribute melarang adanya :other.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => ':Attribute wajib diisi.',
    'required_array_keys'  => ':Attribute harus diisi dengan isian berikut: :values.',
    'required_if'          => ':Attribute wajib diisi saat :other berisi :value.',
    'required_unless'      => ':Attribute wajib diisi kecuali saat :other berisi :values.',
    'required_with'        => ':Attribute wajib diisi saat :values ada.',
    'required_with_all'    => ':Attribute wajib diisi saat :values ada.',
    'required_without'     => ':Attribute wajib diisi saat :values tidak ada.',
    'required_without_all' => ':Attribute wajib diisi sat salah satu dari :values ada.',
    'same'                 => ':Attribute dan :other harus sama.',
    'size'                 => [
        'array'   => ':Attribute harus berisi :size item.',
        'file'    => ':Attribute harus berukuran :size kilobyte.',
        'numeric' => ':Attribute harus berisi :size.',
        'string'  => ':Attribute harus berisi :size karakter.',
    ],
    'starts_with'       => ':Attribute harus diawali dengan salah satu dari: :values.',
    'doesnt_start_with' => ':Attribute tidak boleh diawali dengan salah satu dari: :values.',
    'string'            => ':Attribute harus merupakan string.',
    'timezone'          => ':Attribute harus merupakan timezone yang valid.',
    'unique'            => ':Attribute yang Anda pilih telah terdaftar.',
    'uploaded'          => 'Gagal mengunggah :attribute.',
    'url'               => ':Attribute harus merupakan URL yang valid.',
    'uuid'              => ':Attribute harus merupakan UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        //
    ],

];
