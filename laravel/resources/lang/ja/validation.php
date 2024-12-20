<?php

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

return [
    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeは、有効なURLではありません。',
    'after'                => ':attributeには、:dateより後の日付を指定してください。',
    'after_or_equal'       => ':attributeには、:date以降の日付を指定してください。',
    'alpha'                => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'           => ':attributeには、英数字(\'A-Z\',\'a-z\',\'0-9\')とハイフンと下線(\'-\',\'_\')が使用できます。',
    'alpha_num'            => ':attributeには、英数字(\'A-Z\',\'a-z\',\'0-9\')が使用できます。',
    'array'                => ':attributeには、配列を指定してください。',
    'attached'             => 'この:attributeはすでに添付されています。',
    'before'               => ':attributeには、:dateより前の日付を指定してください。',
    'before_or_equal'      => ':attributeには、:date以前の日付を指定してください。',
    'between'              => [
        'array'   => ':attributeの項目は、:min個から:max個にしてください。',
        'file'    => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'numeric' => ':attributeには、:minから、:maxまでの数字を指定してください。',
        'string'  => ':attributeは、:min文字から:max文字にしてください。',
    ],
    'boolean'              => ':attributeには、\'true\'か\'false\'を指定してください。',
    'confirmed'            => ':attributeと:attribute確認が一致しません。',
    'date'                 => ':attributeは、正しい日付ではありません。',
    'date_equals'          => ':attributeは:dateに等しい日付でなければなりません。',
    'date_format'          => ':attributeの形式は、\':format\'と合いません。',
    'different'            => ':attributeと:otherには、異なるものを指定してください。',
    'digits'               => ':attributeは、:digits桁にしてください。',
    'digits_between'       => ':attributeは、:min桁から:max桁にしてください。',
    'dimensions'           => ':attributeの画像サイズが無効です',
    'distinct'             => ':attributeの値が重複しています。',
    'email'                => ':attributeは、有効なメールアドレス形式で指定してください。',
    'ends_with'            => ':attributeは、次のうちのいずれかで終わらなければなりません。: :values',
    'exists'               => '選択された:attributeは、有効ではありません。',
    'file'                 => ':attributeはファイルでなければいけません。',
    'filled'               => ':attributeは必須です。',
    'gt'                   => [
        'array'   => ':attributeの項目数は、:value個より大きくなければなりません。',
        'file'    => ':attributeは、:value KBより大きくなければなりません。',
        'numeric' => ':attributeは、:valueより大きくなければなりません。',
        'string'  => ':attributeは、:value文字より大きくなければなりません。',
    ],
    'gte'                  => [
        'array'   => ':attributeの項目数は、:value個以上でなければなりません。',
        'file'    => ':attributeは、:value KB以上でなければなりません。',
        'numeric' => ':attributeは、:value以上でなければなりません。',
        'string'  => ':attributeは、:value文字以上でなければなりません。',
    ],
    'image'                => ':attributeには、画像を指定してください。',
    'in'                   => '選択された:attributeは、有効ではありません。',
    'in_array'             => ':attributeが:otherに存在しません。',
    'integer'              => ':attributeには、整数を指定してください。',
    'ip'                   => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4'                 => ':attributeはIPv4アドレスを指定してください。',
    'ipv6'                 => ':attributeはIPv6アドレスを指定してください。',
    'json'                 => ':attributeには、有効なJSON文字列を指定してください。',
    'lt'                   => [
        'array'   => ':attributeの項目数は、:value個より小さくなければなりません。',
        'file'    => ':attributeは、:value KBより小さくなければなりません。',
        'numeric' => ':attributeは、:valueより小さくなければなりません。',
        'string'  => ':attributeは、:value文字より小さくなければなりません。',
    ],
    'lte'                  => [
        'array'   => ':attributeの項目数は、:value個以下でなければなりません。',
        'file'    => ':attributeは、:value KB以下でなければなりません。',
        'numeric' => ':attributeは、:value以下でなければなりません。',
        'string'  => ':attributeは、:value文字以下でなければなりません。',
    ],
    'max'                  => [
        'array'   => ':attributeの項目は、:max個以下にしてください。',
        'file'    => ':attributeには、:max KB以下のファイルを指定してください。',
        'numeric' => ':attributeには、:max以下の数字を指定してください。',
        'string'  => ':attributeは、:max文字以下にしてください。',
    ],
    'mimes'                => ':attributeには、:valuesタイプのファイルを指定してください。',
    'mimetypes'            => ':attributeには、:valuesタイプのファイルを指定してください。',
    'min'                  => [
        'array'   => ':attributeの項目は、:min個以上にしてください。',
        'file'    => ':attributeには、:min KB以上のファイルを指定してください。',
        'numeric' => ':attributeには、:min以上の数字を指定してください。',
        'string'  => ':attributeは、:min文字以上にしてください。',
    ],
    'multiple_of'          => ':attributeは:valueの倍数でなければなりません',
    'not_in'               => '選択された:attributeは、有効ではありません。',
    'not_regex'            => ':attributeの形式が無効です。',
    'numeric'              => ':attributeには、数字を指定してください。',
    'password'             => 'パスワードが正しくありません。',
    'present'              => ':attributeが存在している必要があります。',
    'prohibited'           => ':attributeフィールドは禁止されています。',
    'prohibited_if'        => ':attributeフィールドは、:otherが:valueの場合は禁止されています。',
    'prohibited_unless'    => ':attributeフィールドは、:otherが:valuesでない限り禁止されています。',
    'regex'                => ':attributeには、有効な正規表現を指定してください。',
    'relatable'            => 'この:attributeきない場合に伴い資源です。',
    'required'             => ':attributeは、必ず入力してください。',
    'required_if'          => ':otherが:valueの場合、:attributeを指定してください。',
    'required_unless'      => ':otherが:values以外の場合、:attributeを指定してください。',
    'required_with'        => ':valuesが指定されている場合、:attributeも指定してください。',
    'required_with_all'    => ':valuesが全て指定されている場合、:attributeも指定してください。',
    'required_without'     => ':valuesが指定されていない場合、:attributeを指定してください。',
    'required_without_all' => ':valuesが全て指定されていない場合、:attributeを指定してください。',
    'same'                 => ':attributeと:otherが一致しません。',
    'size'                 => [
        'array'   => ':attributeの項目は、:size個にしてください。',
        'file'    => ':attributeには、:size KBのファイルを指定してください。',
        'numeric' => ':attributeには、:sizeを指定してください。',
        'string'  => ':attributeは、:size文字にしてください。',
    ],
    'starts_with'          => ':attributeは、次のいずれかで始まる必要があります。:values',
    'string'               => ':attributeには、文字を指定してください。',
    'timezone'             => ':attributeには、有効なタイムゾーンを指定してください。',
    'unique'               => '指定の:attributeは既に使用されています。',
    'uploaded'             => ':attributeのアップロードに失敗しました。',
    'url'                  => ':attributeは、有効なURL形式で指定してください。',
    'uuid'                 => ':attributeは、有効なUUIDでなければなりません。',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'max_digits' => ':attributeは、:max桁以内で入力してください。',
    'decimal'    => ':attributeは、指定の小数桁で設定する必要があります。',

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'siireuser_id' => 'ログインID',
        'siireuser_passwd' => 'パスワード',
        'user_id' => 'ログインID',
        'user_passwd' => 'パスワード',

        // Requests\Registration\Step1From
        'brandCode'            => 'ブランド',
        'productName'          => '製品名',
        'productWebikeCodeFlg' => '品番未設定チェック',
        'productCode'          => '品番',
        'openPriceFlg'         => 'オープン価格チェック',
        'producJancode'        => 'JANコード',
        'properPrice'          => '税抜定価',
        'supplierPrice'        => '税抜仕切',
        'supplierPriceRate'    => '仕切率',
        'productSummary'       => '要点',
        'orderProductFlg'      => '受注生産チェック',
        'productCaution'       => '注意',
        'productSentence'      => '説明',

        // Requests\Registration\Step3From
        'video1' => '動画',
        'video2' => '動画',
        'video3' => '動画',
        'video4' => '動画',

        // Requests\Registration\Step4From
        'fitModels'                     => '適合車種',
        'fitModels.*.modelMakerCode'    => 'メーカー',
        'fitModels.*.modelDisplacement' => '排気量',
        'fitModels.*.modelName'         => '車種名',
        'fitModels.*.nensikiFrom'       => '年式(from)',
        'fitModels.*.nensikiOption'     => '年式オプション',
        'fitModels.*.nensikiTo'         => '年式(to)',
        'fitModels.*.modelKatashiki'    => '型式',
        'fitModels.*.modelRemarks'      => '備考',

    ],

    // カスタムバリデーション
    'has_brand'                    => ':attributeが未設定です。',
    'inrange1to95'                 => ':attributeは、定価の1～95%の範囲内で設定してください。',
    'is_requered_product_code'     => ':attributeは、品番未設定チェックがOFFの場合は必須です。',
    'is_num_only'                  => ':attributeは、数字のみ入力できます。',
    'check_len_jan_code'           => ':attributeは、:max桁以内で入力してください。',
    'duplicate_productcode'        => '既にWebikeに同じ品番の商品データが登録済です。',
    'duplicate_jancode'            => '既にWebikeに同じJANコードの商品データが登録済です。',
    'external_link'                => 'WEBサイトURLの入力はできません。',
    'youtube_url'                  => ':attributeが表示されていません。動画URLを確認の上「次へ進む」をクリックしてください。',
    'has_maker'                    => ':attributeが未設定です。',
];
