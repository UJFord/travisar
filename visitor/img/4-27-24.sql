PGDMP  &                    |         
   farm_crops    16.0    16.0 H   |           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            }           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            ~           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    42228 
   farm_crops    DATABASE     �   CREATE DATABASE farm_crops WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE farm_crops;
                postgres    false            �            1259    42229    abiotic_resistance    TABLE     �   CREATE TABLE public.abiotic_resistance (
    abiotic_resistance_id integer NOT NULL,
    abiotic_name character varying(255)
);
 &   DROP TABLE public.abiotic_resistance;
       public         heap    postgres    false            �            1259    42232 ,   abiotic_resistance_abiotic_resistance_id_seq    SEQUENCE     �   CREATE SEQUENCE public.abiotic_resistance_abiotic_resistance_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 C   DROP SEQUENCE public.abiotic_resistance_abiotic_resistance_id_seq;
       public          postgres    false    215            �           0    0 ,   abiotic_resistance_abiotic_resistance_id_seq    SEQUENCE OWNED BY     }   ALTER SEQUENCE public.abiotic_resistance_abiotic_resistance_id_seq OWNED BY public.abiotic_resistance.abiotic_resistance_id;
          public          postgres    false    216            �            1259    42233    account_type    TABLE     q   CREATE TABLE public.account_type (
    account_type_id integer NOT NULL,
    type_name character varying(255)
);
     DROP TABLE public.account_type;
       public         heap    postgres    false            �            1259    42236     account_type_account_type_id_seq    SEQUENCE     �   CREATE SEQUENCE public.account_type_account_type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.account_type_account_type_id_seq;
       public          postgres    false    217            �           0    0     account_type_account_type_id_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.account_type_account_type_id_seq OWNED BY public.account_type.account_type_id;
          public          postgres    false    218            �            1259    42237    barangay    TABLE     �   CREATE TABLE public.barangay (
    barangay_id integer NOT NULL,
    municipality_id integer,
    barangay_name character varying(255)
);
    DROP TABLE public.barangay;
       public         heap    postgres    false            �            1259    42240    barangay_barangay_id_seq    SEQUENCE     �   CREATE SEQUENCE public.barangay_barangay_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.barangay_barangay_id_seq;
       public          postgres    false    219            �           0    0    barangay_barangay_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.barangay_barangay_id_seq OWNED BY public.barangay.barangay_id;
          public          postgres    false    220            �            1259    42241    category    TABLE     m   CREATE TABLE public.category (
    category_id integer NOT NULL,
    category_name character varying(255)
);
    DROP TABLE public.category;
       public         heap    postgres    false            �            1259    42244    category_category_id_seq    SEQUENCE     �   CREATE SEQUENCE public.category_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.category_category_id_seq;
       public          postgres    false    221            �           0    0    category_category_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.category_category_id_seq OWNED BY public.category.category_id;
          public          postgres    false    222            �            1259    42245    category_variety    TABLE     �   CREATE TABLE public.category_variety (
    category_variety_id integer NOT NULL,
    category_id integer,
    category_variety_name character varying(255)
);
 $   DROP TABLE public.category_variety;
       public         heap    postgres    false            �            1259    42248 (   category_variety_category_variety_id_seq    SEQUENCE     �   CREATE SEQUENCE public.category_variety_category_variety_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ?   DROP SEQUENCE public.category_variety_category_variety_id_seq;
       public          postgres    false    223            �           0    0 (   category_variety_category_variety_id_seq    SEQUENCE OWNED BY     u   ALTER SEQUENCE public.category_variety_category_variety_id_seq OWNED BY public.category_variety.category_variety_id;
          public          postgres    false    224            �            1259    42249    corn_abiotic_resistance    TABLE     �   CREATE TABLE public.corn_abiotic_resistance (
    corn_traits_id integer NOT NULL,
    abiotic_resistance_id integer NOT NULL,
    corn_is_checked_abiotic boolean
);
 +   DROP TABLE public.corn_abiotic_resistance;
       public         heap    postgres    false            �            1259    42252    corn_abiotic_resistance_other    TABLE     �   CREATE TABLE public.corn_abiotic_resistance_other (
    corn_abiotic_other_id integer NOT NULL,
    corn_abiotic_other boolean,
    corn_abiotic_other_desc character varying(255)
);
 1   DROP TABLE public.corn_abiotic_resistance_other;
       public         heap    postgres    false            �            1259    42255 7   corn_abiotic_resistance_other_corn_abiotic_other_id_seq    SEQUENCE     �   CREATE SEQUENCE public.corn_abiotic_resistance_other_corn_abiotic_other_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 N   DROP SEQUENCE public.corn_abiotic_resistance_other_corn_abiotic_other_id_seq;
       public          postgres    false    226            �           0    0 7   corn_abiotic_resistance_other_corn_abiotic_other_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.corn_abiotic_resistance_other_corn_abiotic_other_id_seq OWNED BY public.corn_abiotic_resistance_other.corn_abiotic_other_id;
          public          postgres    false    227            �            1259    42256    corn_disease_resistance    TABLE     �   CREATE TABLE public.corn_disease_resistance (
    corn_traits_id integer NOT NULL,
    disease_resistance_id integer NOT NULL,
    corn_is_checked_disease boolean
);
 +   DROP TABLE public.corn_disease_resistance;
       public         heap    postgres    false            �            1259    42259    corn_pest_resistance    TABLE     �   CREATE TABLE public.corn_pest_resistance (
    corn_traits_id integer NOT NULL,
    pest_resistance_id integer NOT NULL,
    corn_is_checked_pest boolean
);
 (   DROP TABLE public.corn_pest_resistance;
       public         heap    postgres    false            �            1259    42262    corn_pest_resistance_other    TABLE     �   CREATE TABLE public.corn_pest_resistance_other (
    corn_pest_other_id integer NOT NULL,
    corn_pest_other boolean,
    corn_pest_other_desc character varying(255)
);
 .   DROP TABLE public.corn_pest_resistance_other;
       public         heap    postgres    false            �            1259    42265 1   corn_pest_resistance_other_corn_pest_other_id_seq    SEQUENCE     �   CREATE SEQUENCE public.corn_pest_resistance_other_corn_pest_other_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 H   DROP SEQUENCE public.corn_pest_resistance_other_corn_pest_other_id_seq;
       public          postgres    false    230            �           0    0 1   corn_pest_resistance_other_corn_pest_other_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.corn_pest_resistance_other_corn_pest_other_id_seq OWNED BY public.corn_pest_resistance_other.corn_pest_other_id;
          public          postgres    false    231            �            1259    42266    corn_traits    TABLE     �   CREATE TABLE public.corn_traits (
    corn_traits_id integer NOT NULL,
    crop_id integer,
    vegetative_state_corn_id integer,
    reproductive_state_corn_id integer,
    corn_pest_other_id integer,
    corn_abiotic_other_id integer
);
    DROP TABLE public.corn_traits;
       public         heap    postgres    false            �            1259    42269    corn_traits_corn_traits_id_seq    SEQUENCE     �   CREATE SEQUENCE public.corn_traits_corn_traits_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.corn_traits_corn_traits_id_seq;
       public          postgres    false    232            �           0    0    corn_traits_corn_traits_id_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.corn_traits_corn_traits_id_seq OWNED BY public.corn_traits.corn_traits_id;
          public          postgres    false    233            �            1259    42270    crop    TABLE     `  CREATE TABLE public.crop (
    crop_id integer NOT NULL,
    crop_variety character varying(255),
    crop_description character varying(255),
    input_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    unique_code character varying(255),
    meaning_of_name character varying(255),
    category_id integer,
    user_id integer,
    crop_seed_image character varying(255),
    crop_vegetative_image character varying(255),
    crop_reproductive_image character varying(255),
    category_variety_id integer,
    terrain_id integer,
    utilization_cultural_id integer,
    status_id integer
);
    DROP TABLE public.crop;
       public         heap    postgres    false            �            1259    42275    crop_crop_id_seq    SEQUENCE     �   CREATE SEQUENCE public.crop_crop_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.crop_crop_id_seq;
       public          postgres    false    234            �           0    0    crop_crop_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.crop_crop_id_seq OWNED BY public.crop.crop_id;
          public          postgres    false    235            �            1259    42276    crop_location    TABLE     �   CREATE TABLE public.crop_location (
    crop_location_id integer NOT NULL,
    crop_id integer,
    municipality_id integer,
    barangay_id integer,
    coordinates character varying(255),
    sitio_name character varying(255)
);
 !   DROP TABLE public.crop_location;
       public         heap    postgres    false            �            1259    42281 "   crop_location_crop_location_id_seq    SEQUENCE     �   CREATE SEQUENCE public.crop_location_crop_location_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.crop_location_crop_location_id_seq;
       public          postgres    false    236            �           0    0 "   crop_location_crop_location_id_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.crop_location_crop_location_id_seq OWNED BY public.crop_location.crop_location_id;
          public          postgres    false    237            �            1259    42282    disease_resistance    TABLE     �   CREATE TABLE public.disease_resistance (
    disease_resistance_id integer NOT NULL,
    disease_name character varying(255)
);
 &   DROP TABLE public.disease_resistance;
       public         heap    postgres    false            �            1259    42285 ,   disease_resistance_disease_resistance_id_seq    SEQUENCE     �   CREATE SEQUENCE public.disease_resistance_disease_resistance_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 C   DROP SEQUENCE public.disease_resistance_disease_resistance_id_seq;
       public          postgres    false    238            �           0    0 ,   disease_resistance_disease_resistance_id_seq    SEQUENCE OWNED BY     }   ALTER SEQUENCE public.disease_resistance_disease_resistance_id_seq OWNED BY public.disease_resistance.disease_resistance_id;
          public          postgres    false    239            �            1259    42286    flag_leaf_traits_rice    TABLE     5  CREATE TABLE public.flag_leaf_traits_rice (
    flag_leaf_traits_rice_id integer NOT NULL,
    flag_length character varying(255),
    flag_width character varying(255),
    purplish_stripes character varying(255),
    pubescence character varying(255),
    flag_remarkable_features character varying(255)
);
 )   DROP TABLE public.flag_leaf_traits_rice;
       public         heap    postgres    false            �            1259    42291 2   flag_leaf_traits_rice_flag_leaf_traits_rice_id_seq    SEQUENCE     �   CREATE SEQUENCE public.flag_leaf_traits_rice_flag_leaf_traits_rice_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 I   DROP SEQUENCE public.flag_leaf_traits_rice_flag_leaf_traits_rice_id_seq;
       public          postgres    false    240            �           0    0 2   flag_leaf_traits_rice_flag_leaf_traits_rice_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.flag_leaf_traits_rice_flag_leaf_traits_rice_id_seq OWNED BY public.flag_leaf_traits_rice.flag_leaf_traits_rice_id;
          public          postgres    false    241            �            1259    42292    municipality    TABLE     �   CREATE TABLE public.municipality (
    municipality_id integer NOT NULL,
    province_id integer,
    municipality_name character varying(255),
    municipality_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
     DROP TABLE public.municipality;
       public         heap    postgres    false            �            1259    42296     municipality_municipality_id_seq    SEQUENCE     �   CREATE SEQUENCE public.municipality_municipality_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.municipality_municipality_id_seq;
       public          postgres    false    242            �           0    0     municipality_municipality_id_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.municipality_municipality_id_seq OWNED BY public.municipality.municipality_id;
          public          postgres    false    243            �            1259    42297    panicle_traits_rice    TABLE       CREATE TABLE public.panicle_traits_rice (
    panicle_traits_rice_id integer NOT NULL,
    panicle_length character varying(255),
    panicle_width character varying(255),
    panicle_enclosed_by character varying(255),
    panicle_remarkable_features character varying(255)
);
 '   DROP TABLE public.panicle_traits_rice;
       public         heap    postgres    false            �            1259    42302 .   panicle_traits_rice_panicle_traits_rice_id_seq    SEQUENCE     �   CREATE SEQUENCE public.panicle_traits_rice_panicle_traits_rice_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 E   DROP SEQUENCE public.panicle_traits_rice_panicle_traits_rice_id_seq;
       public          postgres    false    244            �           0    0 .   panicle_traits_rice_panicle_traits_rice_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.panicle_traits_rice_panicle_traits_rice_id_seq OWNED BY public.panicle_traits_rice.panicle_traits_rice_id;
          public          postgres    false    245            �            1259    42303    pest_resistance    TABLE     w   CREATE TABLE public.pest_resistance (
    pest_resistance_id integer NOT NULL,
    pest_name character varying(255)
);
 #   DROP TABLE public.pest_resistance;
       public         heap    postgres    false            �            1259    42306 &   pest_resistance_pest_resistance_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pest_resistance_pest_resistance_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 =   DROP SEQUENCE public.pest_resistance_pest_resistance_id_seq;
       public          postgres    false    246            �           0    0 &   pest_resistance_pest_resistance_id_seq    SEQUENCE OWNED BY     q   ALTER SEQUENCE public.pest_resistance_pest_resistance_id_seq OWNED BY public.pest_resistance.pest_resistance_id;
          public          postgres    false    247            �            1259    42307    province    TABLE     �   CREATE TABLE public.province (
    province_id integer NOT NULL,
    province_name character varying(255),
    province_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.province;
       public         heap    postgres    false            �            1259    42311    province_province_id_seq    SEQUENCE     �   CREATE SEQUENCE public.province_province_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.province_province_id_seq;
       public          postgres    false    248            �           0    0    province_province_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.province_province_id_seq OWNED BY public.province.province_id;
          public          postgres    false    249            �            1259    42312 
   references    TABLE     ^   CREATE TABLE public."references" (
    references_id integer NOT NULL,
    crop_id integer
);
     DROP TABLE public."references";
       public         heap    postgres    false            �            1259    42315    references_references_id_seq    SEQUENCE     �   CREATE SEQUENCE public.references_references_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.references_references_id_seq;
       public          postgres    false    250            �           0    0    references_references_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.references_references_id_seq OWNED BY public."references".references_id;
          public          postgres    false    251            �            1259    42316    reproductive_state_corn    TABLE     �   CREATE TABLE public.reproductive_state_corn (
    reproductive_state_corn_id integer NOT NULL,
    corn_yield_capacity character varying(255),
    seed_traits_id integer
);
 +   DROP TABLE public.reproductive_state_corn;
       public         heap    postgres    false            �            1259    42319 6   reproductive_state_corn_reproductive_state_corn_id_seq    SEQUENCE     �   CREATE SEQUENCE public.reproductive_state_corn_reproductive_state_corn_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 M   DROP SEQUENCE public.reproductive_state_corn_reproductive_state_corn_id_seq;
       public          postgres    false    252            �           0    0 6   reproductive_state_corn_reproductive_state_corn_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.reproductive_state_corn_reproductive_state_corn_id_seq OWNED BY public.reproductive_state_corn.reproductive_state_corn_id;
          public          postgres    false    253            �            1259    42320    reproductive_state_rice    TABLE     �   CREATE TABLE public.reproductive_state_rice (
    reproductive_state_rice_id integer NOT NULL,
    rice_yield_capacity character varying(255),
    panicle_traits_rice_id integer,
    seed_traits_id integer,
    flag_leaf_traits_rice_id integer
);
 +   DROP TABLE public.reproductive_state_rice;
       public         heap    postgres    false            �            1259    42323 6   reproductive_state_rice_reproductive_state_rice_id_seq    SEQUENCE     �   CREATE SEQUENCE public.reproductive_state_rice_reproductive_state_rice_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 M   DROP SEQUENCE public.reproductive_state_rice_reproductive_state_rice_id_seq;
       public          postgres    false    254            �           0    0 6   reproductive_state_rice_reproductive_state_rice_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.reproductive_state_rice_reproductive_state_rice_id_seq OWNED BY public.reproductive_state_rice.reproductive_state_rice_id;
          public          postgres    false    255                        1259    42324    rice_abiotic_resistance    TABLE     �   CREATE TABLE public.rice_abiotic_resistance (
    rice_traits_id integer NOT NULL,
    abiotic_resistance_id integer NOT NULL,
    rice_is_checked_abiotic boolean
);
 +   DROP TABLE public.rice_abiotic_resistance;
       public         heap    postgres    false                       1259    42327    rice_abiotic_resistance_other    TABLE     �   CREATE TABLE public.rice_abiotic_resistance_other (
    rice_abiotic_other_id integer NOT NULL,
    rice_abiotic_other boolean,
    rice_abiotic_other_desc character varying(255)
);
 1   DROP TABLE public.rice_abiotic_resistance_other;
       public         heap    postgres    false                       1259    42330 7   rice_abiotic_resistance_other_rice_abiotic_other_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rice_abiotic_resistance_other_rice_abiotic_other_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 N   DROP SEQUENCE public.rice_abiotic_resistance_other_rice_abiotic_other_id_seq;
       public          postgres    false    257            �           0    0 7   rice_abiotic_resistance_other_rice_abiotic_other_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.rice_abiotic_resistance_other_rice_abiotic_other_id_seq OWNED BY public.rice_abiotic_resistance_other.rice_abiotic_other_id;
          public          postgres    false    258                       1259    42331    rice_disease_resistance    TABLE     �   CREATE TABLE public.rice_disease_resistance (
    rice_traits_id integer NOT NULL,
    disease_resistance_id integer NOT NULL,
    rice_is_checked_disease boolean
);
 +   DROP TABLE public.rice_disease_resistance;
       public         heap    postgres    false                       1259    42334    rice_pest_resistance    TABLE     �   CREATE TABLE public.rice_pest_resistance (
    rice_traits_id integer NOT NULL,
    pest_resistance_id integer NOT NULL,
    rice_is_checked_pest boolean
);
 (   DROP TABLE public.rice_pest_resistance;
       public         heap    postgres    false                       1259    42337    rice_pest_resistance_other    TABLE     �   CREATE TABLE public.rice_pest_resistance_other (
    rice_pest_other_id integer NOT NULL,
    rice_pest_other boolean,
    rice_pest_other_desc character varying(255)
);
 .   DROP TABLE public.rice_pest_resistance_other;
       public         heap    postgres    false                       1259    42340 1   rice_pest_resistance_other_rice_pest_other_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rice_pest_resistance_other_rice_pest_other_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 H   DROP SEQUENCE public.rice_pest_resistance_other_rice_pest_other_id_seq;
       public          postgres    false    261            �           0    0 1   rice_pest_resistance_other_rice_pest_other_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.rice_pest_resistance_other_rice_pest_other_id_seq OWNED BY public.rice_pest_resistance_other.rice_pest_other_id;
          public          postgres    false    262                       1259    42341    rice_traits    TABLE       CREATE TABLE public.rice_traits (
    rice_traits_id integer NOT NULL,
    crop_id integer,
    vegetative_state_rice_id integer,
    reproductive_state_rice_id integer,
    sensory_traits_rice_id integer,
    rice_pest_other_id integer,
    rice_abiotic_other_id integer
);
    DROP TABLE public.rice_traits;
       public         heap    postgres    false                       1259    42344    rice_traits_rice_traits_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rice_traits_rice_traits_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.rice_traits_rice_traits_id_seq;
       public          postgres    false    263            �           0    0    rice_traits_rice_traits_id_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.rice_traits_rice_traits_id_seq OWNED BY public.rice_traits.rice_traits_id;
          public          postgres    false    264            	           1259    42345    root_crop_traits    TABLE     �   CREATE TABLE public.root_crop_traits (
    root_crop_traits_id integer NOT NULL,
    crop_id integer,
    vegetative_state_rootcrop_id integer,
    rootcrop_traits_id integer,
    rootcrop_pest_other_id integer,
    rootcrop_abiotic_other_id integer
);
 $   DROP TABLE public.root_crop_traits;
       public         heap    postgres    false            
           1259    42348 (   root_crop_traits_root_crop_traits_id_seq    SEQUENCE     �   CREATE SEQUENCE public.root_crop_traits_root_crop_traits_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ?   DROP SEQUENCE public.root_crop_traits_root_crop_traits_id_seq;
       public          postgres    false    265            �           0    0 (   root_crop_traits_root_crop_traits_id_seq    SEQUENCE OWNED BY     u   ALTER SEQUENCE public.root_crop_traits_root_crop_traits_id_seq OWNED BY public.root_crop_traits.root_crop_traits_id;
          public          postgres    false    266                       1259    42349    rootcrop_abiotic_resistance    TABLE     �   CREATE TABLE public.rootcrop_abiotic_resistance (
    root_crop_traits_id integer NOT NULL,
    abiotic_resistance_id integer NOT NULL,
    rootcrop_is_checked_abiotic boolean
);
 /   DROP TABLE public.rootcrop_abiotic_resistance;
       public         heap    postgres    false                       1259    42352 !   rootcrop_abiotic_resistance_other    TABLE     �   CREATE TABLE public.rootcrop_abiotic_resistance_other (
    rootcrop_abiotic_other_id integer NOT NULL,
    rootcrop_abiotic_other boolean,
    rootcrop_abiotic_other_desc character varying(255)
);
 5   DROP TABLE public.rootcrop_abiotic_resistance_other;
       public         heap    postgres    false                       1259    42355 ?   rootcrop_abiotic_resistance_othe_root_crop_abiotic_other_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rootcrop_abiotic_resistance_othe_root_crop_abiotic_other_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 V   DROP SEQUENCE public.rootcrop_abiotic_resistance_othe_root_crop_abiotic_other_id_seq;
       public          postgres    false    268            �           0    0 ?   rootcrop_abiotic_resistance_othe_root_crop_abiotic_other_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.rootcrop_abiotic_resistance_othe_root_crop_abiotic_other_id_seq OWNED BY public.rootcrop_abiotic_resistance_other.rootcrop_abiotic_other_id;
          public          postgres    false    269                       1259    42356    rootcrop_disease_resistance    TABLE     �   CREATE TABLE public.rootcrop_disease_resistance (
    root_crop_traits_id integer NOT NULL,
    disease_resistance_id integer NOT NULL,
    rootcrop_is_checked_disease boolean
);
 /   DROP TABLE public.rootcrop_disease_resistance;
       public         heap    postgres    false                       1259    42359    rootcrop_pest_resistance    TABLE     �   CREATE TABLE public.rootcrop_pest_resistance (
    root_crop_traits_id integer NOT NULL,
    pest_resistance_id integer NOT NULL,
    rootcrop_is_checked_pest boolean
);
 ,   DROP TABLE public.rootcrop_pest_resistance;
       public         heap    postgres    false                       1259    42362    rootcrop_pest_resistance_other    TABLE     �   CREATE TABLE public.rootcrop_pest_resistance_other (
    rootcrop_pest_other_id integer NOT NULL,
    rootcrop_pest_other boolean,
    rootcrop_pest_other_desc character varying(255)
);
 2   DROP TABLE public.rootcrop_pest_resistance_other;
       public         heap    postgres    false                       1259    42365 :   rootcrop_pest_resistance_other_root_crop_pest_other_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rootcrop_pest_resistance_other_root_crop_pest_other_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 Q   DROP SEQUENCE public.rootcrop_pest_resistance_other_root_crop_pest_other_id_seq;
       public          postgres    false    272            �           0    0 :   rootcrop_pest_resistance_other_root_crop_pest_other_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.rootcrop_pest_resistance_other_root_crop_pest_other_id_seq OWNED BY public.rootcrop_pest_resistance_other.rootcrop_pest_other_id;
          public          postgres    false    273                       1259    42366    rootcrop_traits    TABLE       CREATE TABLE public.rootcrop_traits (
    rootcrop_traits_id integer NOT NULL,
    eating_quality character varying(255),
    rootcrop_color character varying(255),
    sweetness character varying(255),
    rootcrop_remarkable_features character varying(255)
);
 #   DROP TABLE public.rootcrop_traits;
       public         heap    postgres    false                       1259    42371 &   rootcrop_traits_rootcrop_traits_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rootcrop_traits_rootcrop_traits_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 =   DROP SEQUENCE public.rootcrop_traits_rootcrop_traits_id_seq;
       public          postgres    false    274            �           0    0 &   rootcrop_traits_rootcrop_traits_id_seq    SEQUENCE OWNED BY     q   ALTER SEQUENCE public.rootcrop_traits_rootcrop_traits_id_seq OWNED BY public.rootcrop_traits.rootcrop_traits_id;
          public          postgres    false    275                       1259    42372    seed_traits    TABLE     �   CREATE TABLE public.seed_traits (
    seed_traits_id integer NOT NULL,
    seed_length character varying(255),
    seed_width character varying(255),
    seed_shape character varying(255),
    seed_color character varying(255)
);
    DROP TABLE public.seed_traits;
       public         heap    postgres    false                       1259    42377    seed_traits_seed_traits_id_seq    SEQUENCE     �   CREATE SEQUENCE public.seed_traits_seed_traits_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.seed_traits_seed_traits_id_seq;
       public          postgres    false    276            �           0    0    seed_traits_seed_traits_id_seq    SEQUENCE OWNED BY     a   ALTER SEQUENCE public.seed_traits_seed_traits_id_seq OWNED BY public.seed_traits.seed_traits_id;
          public          postgres    false    277                       1259    42378    sensory_traits_rice    TABLE     U  CREATE TABLE public.sensory_traits_rice (
    sensory_traits_rice_id integer NOT NULL,
    aroma character varying(255),
    quality_cooked_rice character varying(255),
    quality_leftover_rice character varying(255),
    volume_expansion character varying(255),
    glutinous character varying(255),
    hardness character varying(255)
);
 '   DROP TABLE public.sensory_traits_rice;
       public         heap    postgres    false                       1259    42383 .   sensory_traits_rice_sensory_traits_rice_id_seq    SEQUENCE     �   CREATE SEQUENCE public.sensory_traits_rice_sensory_traits_rice_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 E   DROP SEQUENCE public.sensory_traits_rice_sensory_traits_rice_id_seq;
       public          postgres    false    278            �           0    0 .   sensory_traits_rice_sensory_traits_rice_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.sensory_traits_rice_sensory_traits_rice_id_seq OWNED BY public.sensory_traits_rice.sensory_traits_rice_id;
          public          postgres    false    279                       1259    42384    status    TABLE     �   CREATE TABLE public.status (
    status_id integer NOT NULL,
    status_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    remarks character varying(255),
    action character varying
);
    DROP TABLE public.status;
       public         heap    postgres    false                       1259    42389    status_status_id_seq    SEQUENCE     �   CREATE SEQUENCE public.status_status_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.status_status_id_seq;
       public          postgres    false    280            �           0    0    status_status_id_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.status_status_id_seq OWNED BY public.status.status_id;
          public          postgres    false    281                       1259    42390    terrain    TABLE     j   CREATE TABLE public.terrain (
    terrain_id integer NOT NULL,
    terrain_name character varying(255)
);
    DROP TABLE public.terrain;
       public         heap    postgres    false                       1259    42393    terrain_terrain_id_seq    SEQUENCE     �   CREATE SEQUENCE public.terrain_terrain_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.terrain_terrain_id_seq;
       public          postgres    false    282            �           0    0    terrain_terrain_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.terrain_terrain_id_seq OWNED BY public.terrain.terrain_id;
          public          postgres    false    283                       1259    42394    users    TABLE     �  CREATE TABLE public.users (
    user_id integer NOT NULL,
    first_name character varying(255),
    last_name character varying(255),
    gender character varying(255),
    email character varying(255),
    password character varying(255),
    affiliation character varying(255),
    username character varying(255),
    email_verified character varying(255),
    account_type_id integer,
    registration_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.users;
       public         heap    postgres    false                       1259    42399    users_user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.users_user_id_seq;
       public          postgres    false    284            �           0    0    users_user_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;
          public          postgres    false    285                       1259    42400    utilization_cultural_importance    TABLE       CREATE TABLE public.utilization_cultural_importance (
    utilization_cultural_id integer NOT NULL,
    significance character varying(255),
    use character varying(255),
    indigenous_utilization character varying(255),
    remarkable_features character varying(255)
);
 3   DROP TABLE public.utilization_cultural_importance;
       public         heap    postgres    false                       1259    42405 <   utilization_cultural_importance_utillization_cultural_id_seq    SEQUENCE     �   CREATE SEQUENCE public.utilization_cultural_importance_utillization_cultural_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 S   DROP SEQUENCE public.utilization_cultural_importance_utillization_cultural_id_seq;
       public          postgres    false    286            �           0    0 <   utilization_cultural_importance_utillization_cultural_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.utilization_cultural_importance_utillization_cultural_id_seq OWNED BY public.utilization_cultural_importance.utilization_cultural_id;
          public          postgres    false    287                        1259    42406    vegetative_state_corn    TABLE       CREATE TABLE public.vegetative_state_corn (
    vegetative_state_corn_id integer NOT NULL,
    corn_plant_height character varying(255),
    corn_leaf_width character varying(255),
    corn_leaf_length character varying(255),
    corn_maturity_time character varying(255)
);
 )   DROP TABLE public.vegetative_state_corn;
       public         heap    postgres    false            !           1259    42411 2   vegetative_state_corn_vegetative_state_corn_id_seq    SEQUENCE     �   CREATE SEQUENCE public.vegetative_state_corn_vegetative_state_corn_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 I   DROP SEQUENCE public.vegetative_state_corn_vegetative_state_corn_id_seq;
       public          postgres    false    288            �           0    0 2   vegetative_state_corn_vegetative_state_corn_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.vegetative_state_corn_vegetative_state_corn_id_seq OWNED BY public.vegetative_state_corn.vegetative_state_corn_id;
          public          postgres    false    289            "           1259    42412    vegetative_state_rice    TABLE     F  CREATE TABLE public.vegetative_state_rice (
    vegetative_state_rice_id integer NOT NULL,
    rice_plant_height character varying(255),
    rice_leaf_width character varying(255),
    rice_leaf_length character varying(255),
    rice_tillering_ability character varying(255),
    rice_maturity_time character varying(255)
);
 )   DROP TABLE public.vegetative_state_rice;
       public         heap    postgres    false            #           1259    42417 2   vegetative_state_rice_vegetative_state_rice_id_seq    SEQUENCE     �   CREATE SEQUENCE public.vegetative_state_rice_vegetative_state_rice_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 I   DROP SEQUENCE public.vegetative_state_rice_vegetative_state_rice_id_seq;
       public          postgres    false    290            �           0    0 2   vegetative_state_rice_vegetative_state_rice_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.vegetative_state_rice_vegetative_state_rice_id_seq OWNED BY public.vegetative_state_rice.vegetative_state_rice_id;
          public          postgres    false    291            $           1259    42418    vegetative_state_rootcrop    TABLE     _  CREATE TABLE public.vegetative_state_rootcrop (
    vegetative_state_rootcrop_id integer NOT NULL,
    rootcrop_plant_height character varying(255),
    rootcrop_leaf_width character varying(255),
    rootcrop_leaf_length character varying(255),
    rootcrop_stem_leaf_desc character varying(255),
    rootcrop_maturity_time character varying(255)
);
 -   DROP TABLE public.vegetative_state_rootcrop;
       public         heap    postgres    false            %           1259    42423 :   vegetative_state_rootcrop_vegetative_state_rootcrop_id_seq    SEQUENCE     �   CREATE SEQUENCE public.vegetative_state_rootcrop_vegetative_state_rootcrop_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 Q   DROP SEQUENCE public.vegetative_state_rootcrop_vegetative_state_rootcrop_id_seq;
       public          postgres    false    292            �           0    0 :   vegetative_state_rootcrop_vegetative_state_rootcrop_id_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.vegetative_state_rootcrop_vegetative_state_rootcrop_id_seq OWNED BY public.vegetative_state_rootcrop.vegetative_state_rootcrop_id;
          public          postgres    false    293            �           2604    42424 (   abiotic_resistance abiotic_resistance_id    DEFAULT     �   ALTER TABLE ONLY public.abiotic_resistance ALTER COLUMN abiotic_resistance_id SET DEFAULT nextval('public.abiotic_resistance_abiotic_resistance_id_seq'::regclass);
 W   ALTER TABLE public.abiotic_resistance ALTER COLUMN abiotic_resistance_id DROP DEFAULT;
       public          postgres    false    216    215            �           2604    42425    account_type account_type_id    DEFAULT     �   ALTER TABLE ONLY public.account_type ALTER COLUMN account_type_id SET DEFAULT nextval('public.account_type_account_type_id_seq'::regclass);
 K   ALTER TABLE public.account_type ALTER COLUMN account_type_id DROP DEFAULT;
       public          postgres    false    218    217            �           2604    42426    barangay barangay_id    DEFAULT     |   ALTER TABLE ONLY public.barangay ALTER COLUMN barangay_id SET DEFAULT nextval('public.barangay_barangay_id_seq'::regclass);
 C   ALTER TABLE public.barangay ALTER COLUMN barangay_id DROP DEFAULT;
       public          postgres    false    220    219            �           2604    42427    category category_id    DEFAULT     |   ALTER TABLE ONLY public.category ALTER COLUMN category_id SET DEFAULT nextval('public.category_category_id_seq'::regclass);
 C   ALTER TABLE public.category ALTER COLUMN category_id DROP DEFAULT;
       public          postgres    false    222    221            �           2604    42428 $   category_variety category_variety_id    DEFAULT     �   ALTER TABLE ONLY public.category_variety ALTER COLUMN category_variety_id SET DEFAULT nextval('public.category_variety_category_variety_id_seq'::regclass);
 S   ALTER TABLE public.category_variety ALTER COLUMN category_variety_id DROP DEFAULT;
       public          postgres    false    224    223            �           2604    42429 3   corn_abiotic_resistance_other corn_abiotic_other_id    DEFAULT     �   ALTER TABLE ONLY public.corn_abiotic_resistance_other ALTER COLUMN corn_abiotic_other_id SET DEFAULT nextval('public.corn_abiotic_resistance_other_corn_abiotic_other_id_seq'::regclass);
 b   ALTER TABLE public.corn_abiotic_resistance_other ALTER COLUMN corn_abiotic_other_id DROP DEFAULT;
       public          postgres    false    227    226            �           2604    42430 -   corn_pest_resistance_other corn_pest_other_id    DEFAULT     �   ALTER TABLE ONLY public.corn_pest_resistance_other ALTER COLUMN corn_pest_other_id SET DEFAULT nextval('public.corn_pest_resistance_other_corn_pest_other_id_seq'::regclass);
 \   ALTER TABLE public.corn_pest_resistance_other ALTER COLUMN corn_pest_other_id DROP DEFAULT;
       public          postgres    false    231    230            �           2604    42431    corn_traits corn_traits_id    DEFAULT     �   ALTER TABLE ONLY public.corn_traits ALTER COLUMN corn_traits_id SET DEFAULT nextval('public.corn_traits_corn_traits_id_seq'::regclass);
 I   ALTER TABLE public.corn_traits ALTER COLUMN corn_traits_id DROP DEFAULT;
       public          postgres    false    233    232            �           2604    42432    crop crop_id    DEFAULT     l   ALTER TABLE ONLY public.crop ALTER COLUMN crop_id SET DEFAULT nextval('public.crop_crop_id_seq'::regclass);
 ;   ALTER TABLE public.crop ALTER COLUMN crop_id DROP DEFAULT;
       public          postgres    false    235    234            �           2604    42433    crop_location crop_location_id    DEFAULT     �   ALTER TABLE ONLY public.crop_location ALTER COLUMN crop_location_id SET DEFAULT nextval('public.crop_location_crop_location_id_seq'::regclass);
 M   ALTER TABLE public.crop_location ALTER COLUMN crop_location_id DROP DEFAULT;
       public          postgres    false    237    236            �           2604    42434 (   disease_resistance disease_resistance_id    DEFAULT     �   ALTER TABLE ONLY public.disease_resistance ALTER COLUMN disease_resistance_id SET DEFAULT nextval('public.disease_resistance_disease_resistance_id_seq'::regclass);
 W   ALTER TABLE public.disease_resistance ALTER COLUMN disease_resistance_id DROP DEFAULT;
       public          postgres    false    239    238            �           2604    42435 .   flag_leaf_traits_rice flag_leaf_traits_rice_id    DEFAULT     �   ALTER TABLE ONLY public.flag_leaf_traits_rice ALTER COLUMN flag_leaf_traits_rice_id SET DEFAULT nextval('public.flag_leaf_traits_rice_flag_leaf_traits_rice_id_seq'::regclass);
 ]   ALTER TABLE public.flag_leaf_traits_rice ALTER COLUMN flag_leaf_traits_rice_id DROP DEFAULT;
       public          postgres    false    241    240            �           2604    42436    municipality municipality_id    DEFAULT     �   ALTER TABLE ONLY public.municipality ALTER COLUMN municipality_id SET DEFAULT nextval('public.municipality_municipality_id_seq'::regclass);
 K   ALTER TABLE public.municipality ALTER COLUMN municipality_id DROP DEFAULT;
       public          postgres    false    243    242            �           2604    42437 *   panicle_traits_rice panicle_traits_rice_id    DEFAULT     �   ALTER TABLE ONLY public.panicle_traits_rice ALTER COLUMN panicle_traits_rice_id SET DEFAULT nextval('public.panicle_traits_rice_panicle_traits_rice_id_seq'::regclass);
 Y   ALTER TABLE public.panicle_traits_rice ALTER COLUMN panicle_traits_rice_id DROP DEFAULT;
       public          postgres    false    245    244            �           2604    42438 "   pest_resistance pest_resistance_id    DEFAULT     �   ALTER TABLE ONLY public.pest_resistance ALTER COLUMN pest_resistance_id SET DEFAULT nextval('public.pest_resistance_pest_resistance_id_seq'::regclass);
 Q   ALTER TABLE public.pest_resistance ALTER COLUMN pest_resistance_id DROP DEFAULT;
       public          postgres    false    247    246            �           2604    42439    province province_id    DEFAULT     |   ALTER TABLE ONLY public.province ALTER COLUMN province_id SET DEFAULT nextval('public.province_province_id_seq'::regclass);
 C   ALTER TABLE public.province ALTER COLUMN province_id DROP DEFAULT;
       public          postgres    false    249    248            �           2604    42440    references references_id    DEFAULT     �   ALTER TABLE ONLY public."references" ALTER COLUMN references_id SET DEFAULT nextval('public.references_references_id_seq'::regclass);
 I   ALTER TABLE public."references" ALTER COLUMN references_id DROP DEFAULT;
       public          postgres    false    251    250            �           2604    42441 2   reproductive_state_corn reproductive_state_corn_id    DEFAULT     �   ALTER TABLE ONLY public.reproductive_state_corn ALTER COLUMN reproductive_state_corn_id SET DEFAULT nextval('public.reproductive_state_corn_reproductive_state_corn_id_seq'::regclass);
 a   ALTER TABLE public.reproductive_state_corn ALTER COLUMN reproductive_state_corn_id DROP DEFAULT;
       public          postgres    false    253    252            �           2604    42442 2   reproductive_state_rice reproductive_state_rice_id    DEFAULT     �   ALTER TABLE ONLY public.reproductive_state_rice ALTER COLUMN reproductive_state_rice_id SET DEFAULT nextval('public.reproductive_state_rice_reproductive_state_rice_id_seq'::regclass);
 a   ALTER TABLE public.reproductive_state_rice ALTER COLUMN reproductive_state_rice_id DROP DEFAULT;
       public          postgres    false    255    254            �           2604    42443 3   rice_abiotic_resistance_other rice_abiotic_other_id    DEFAULT     �   ALTER TABLE ONLY public.rice_abiotic_resistance_other ALTER COLUMN rice_abiotic_other_id SET DEFAULT nextval('public.rice_abiotic_resistance_other_rice_abiotic_other_id_seq'::regclass);
 b   ALTER TABLE public.rice_abiotic_resistance_other ALTER COLUMN rice_abiotic_other_id DROP DEFAULT;
       public          postgres    false    258    257            �           2604    42444 -   rice_pest_resistance_other rice_pest_other_id    DEFAULT     �   ALTER TABLE ONLY public.rice_pest_resistance_other ALTER COLUMN rice_pest_other_id SET DEFAULT nextval('public.rice_pest_resistance_other_rice_pest_other_id_seq'::regclass);
 \   ALTER TABLE public.rice_pest_resistance_other ALTER COLUMN rice_pest_other_id DROP DEFAULT;
       public          postgres    false    262    261                        2604    42445    rice_traits rice_traits_id    DEFAULT     �   ALTER TABLE ONLY public.rice_traits ALTER COLUMN rice_traits_id SET DEFAULT nextval('public.rice_traits_rice_traits_id_seq'::regclass);
 I   ALTER TABLE public.rice_traits ALTER COLUMN rice_traits_id DROP DEFAULT;
       public          postgres    false    264    263                       2604    42446 $   root_crop_traits root_crop_traits_id    DEFAULT     �   ALTER TABLE ONLY public.root_crop_traits ALTER COLUMN root_crop_traits_id SET DEFAULT nextval('public.root_crop_traits_root_crop_traits_id_seq'::regclass);
 S   ALTER TABLE public.root_crop_traits ALTER COLUMN root_crop_traits_id DROP DEFAULT;
       public          postgres    false    266    265                       2604    42447 ;   rootcrop_abiotic_resistance_other rootcrop_abiotic_other_id    DEFAULT     �   ALTER TABLE ONLY public.rootcrop_abiotic_resistance_other ALTER COLUMN rootcrop_abiotic_other_id SET DEFAULT nextval('public.rootcrop_abiotic_resistance_othe_root_crop_abiotic_other_id_seq'::regclass);
 j   ALTER TABLE public.rootcrop_abiotic_resistance_other ALTER COLUMN rootcrop_abiotic_other_id DROP DEFAULT;
       public          postgres    false    269    268                       2604    42448 5   rootcrop_pest_resistance_other rootcrop_pest_other_id    DEFAULT     �   ALTER TABLE ONLY public.rootcrop_pest_resistance_other ALTER COLUMN rootcrop_pest_other_id SET DEFAULT nextval('public.rootcrop_pest_resistance_other_root_crop_pest_other_id_seq'::regclass);
 d   ALTER TABLE public.rootcrop_pest_resistance_other ALTER COLUMN rootcrop_pest_other_id DROP DEFAULT;
       public          postgres    false    273    272                       2604    42449 "   rootcrop_traits rootcrop_traits_id    DEFAULT     �   ALTER TABLE ONLY public.rootcrop_traits ALTER COLUMN rootcrop_traits_id SET DEFAULT nextval('public.rootcrop_traits_rootcrop_traits_id_seq'::regclass);
 Q   ALTER TABLE public.rootcrop_traits ALTER COLUMN rootcrop_traits_id DROP DEFAULT;
       public          postgres    false    275    274                       2604    42450    seed_traits seed_traits_id    DEFAULT     �   ALTER TABLE ONLY public.seed_traits ALTER COLUMN seed_traits_id SET DEFAULT nextval('public.seed_traits_seed_traits_id_seq'::regclass);
 I   ALTER TABLE public.seed_traits ALTER COLUMN seed_traits_id DROP DEFAULT;
       public          postgres    false    277    276                       2604    42451 *   sensory_traits_rice sensory_traits_rice_id    DEFAULT     �   ALTER TABLE ONLY public.sensory_traits_rice ALTER COLUMN sensory_traits_rice_id SET DEFAULT nextval('public.sensory_traits_rice_sensory_traits_rice_id_seq'::regclass);
 Y   ALTER TABLE public.sensory_traits_rice ALTER COLUMN sensory_traits_rice_id DROP DEFAULT;
       public          postgres    false    279    278                       2604    42452    status status_id    DEFAULT     t   ALTER TABLE ONLY public.status ALTER COLUMN status_id SET DEFAULT nextval('public.status_status_id_seq'::regclass);
 ?   ALTER TABLE public.status ALTER COLUMN status_id DROP DEFAULT;
       public          postgres    false    281    280            	           2604    42453    terrain terrain_id    DEFAULT     x   ALTER TABLE ONLY public.terrain ALTER COLUMN terrain_id SET DEFAULT nextval('public.terrain_terrain_id_seq'::regclass);
 A   ALTER TABLE public.terrain ALTER COLUMN terrain_id DROP DEFAULT;
       public          postgres    false    283    282            
           2604    42454    users user_id    DEFAULT     n   ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);
 <   ALTER TABLE public.users ALTER COLUMN user_id DROP DEFAULT;
       public          postgres    false    285    284                       2604    42455 7   utilization_cultural_importance utilization_cultural_id    DEFAULT     �   ALTER TABLE ONLY public.utilization_cultural_importance ALTER COLUMN utilization_cultural_id SET DEFAULT nextval('public.utilization_cultural_importance_utillization_cultural_id_seq'::regclass);
 f   ALTER TABLE public.utilization_cultural_importance ALTER COLUMN utilization_cultural_id DROP DEFAULT;
       public          postgres    false    287    286                       2604    42456 .   vegetative_state_corn vegetative_state_corn_id    DEFAULT     �   ALTER TABLE ONLY public.vegetative_state_corn ALTER COLUMN vegetative_state_corn_id SET DEFAULT nextval('public.vegetative_state_corn_vegetative_state_corn_id_seq'::regclass);
 ]   ALTER TABLE public.vegetative_state_corn ALTER COLUMN vegetative_state_corn_id DROP DEFAULT;
       public          postgres    false    289    288                       2604    42457 .   vegetative_state_rice vegetative_state_rice_id    DEFAULT     �   ALTER TABLE ONLY public.vegetative_state_rice ALTER COLUMN vegetative_state_rice_id SET DEFAULT nextval('public.vegetative_state_rice_vegetative_state_rice_id_seq'::regclass);
 ]   ALTER TABLE public.vegetative_state_rice ALTER COLUMN vegetative_state_rice_id DROP DEFAULT;
       public          postgres    false    291    290                       2604    42458 6   vegetative_state_rootcrop vegetative_state_rootcrop_id    DEFAULT     �   ALTER TABLE ONLY public.vegetative_state_rootcrop ALTER COLUMN vegetative_state_rootcrop_id SET DEFAULT nextval('public.vegetative_state_rootcrop_vegetative_state_rootcrop_id_seq'::regclass);
 e   ALTER TABLE public.vegetative_state_rootcrop ALTER COLUMN vegetative_state_rootcrop_id DROP DEFAULT;
       public          postgres    false    293    292            +          0    42229    abiotic_resistance 
   TABLE DATA           Q   COPY public.abiotic_resistance (abiotic_resistance_id, abiotic_name) FROM stdin;
    public          postgres    false    215   G�      -          0    42233    account_type 
   TABLE DATA           B   COPY public.account_type (account_type_id, type_name) FROM stdin;
    public          postgres    false    217   ��      /          0    42237    barangay 
   TABLE DATA           O   COPY public.barangay (barangay_id, municipality_id, barangay_name) FROM stdin;
    public          postgres    false    219   ��      1          0    42241    category 
   TABLE DATA           >   COPY public.category (category_id, category_name) FROM stdin;
    public          postgres    false    221   �      3          0    42245    category_variety 
   TABLE DATA           c   COPY public.category_variety (category_variety_id, category_id, category_variety_name) FROM stdin;
    public          postgres    false    223   K�      5          0    42249    corn_abiotic_resistance 
   TABLE DATA           q   COPY public.corn_abiotic_resistance (corn_traits_id, abiotic_resistance_id, corn_is_checked_abiotic) FROM stdin;
    public          postgres    false    225   ��      6          0    42252    corn_abiotic_resistance_other 
   TABLE DATA           {   COPY public.corn_abiotic_resistance_other (corn_abiotic_other_id, corn_abiotic_other, corn_abiotic_other_desc) FROM stdin;
    public          postgres    false    226   ��      8          0    42256    corn_disease_resistance 
   TABLE DATA           q   COPY public.corn_disease_resistance (corn_traits_id, disease_resistance_id, corn_is_checked_disease) FROM stdin;
    public          postgres    false    228   4�      9          0    42259    corn_pest_resistance 
   TABLE DATA           h   COPY public.corn_pest_resistance (corn_traits_id, pest_resistance_id, corn_is_checked_pest) FROM stdin;
    public          postgres    false    229   q�      :          0    42262    corn_pest_resistance_other 
   TABLE DATA           o   COPY public.corn_pest_resistance_other (corn_pest_other_id, corn_pest_other, corn_pest_other_desc) FROM stdin;
    public          postgres    false    230   ��      <          0    42266    corn_traits 
   TABLE DATA           �   COPY public.corn_traits (corn_traits_id, crop_id, vegetative_state_corn_id, reproductive_state_corn_id, corn_pest_other_id, corn_abiotic_other_id) FROM stdin;
    public          postgres    false    232   '�      >          0    42270    crop 
   TABLE DATA             COPY public.crop (crop_id, crop_variety, crop_description, input_date, unique_code, meaning_of_name, category_id, user_id, crop_seed_image, crop_vegetative_image, crop_reproductive_image, category_variety_id, terrain_id, utilization_cultural_id, status_id) FROM stdin;
    public          postgres    false    234   ��      @          0    42276    crop_location 
   TABLE DATA           y   COPY public.crop_location (crop_location_id, crop_id, municipality_id, barangay_id, coordinates, sitio_name) FROM stdin;
    public          postgres    false    236   ~�      B          0    42282    disease_resistance 
   TABLE DATA           Q   COPY public.disease_resistance (disease_resistance_id, disease_name) FROM stdin;
    public          postgres    false    238   t�      D          0    42286    flag_leaf_traits_rice 
   TABLE DATA           �   COPY public.flag_leaf_traits_rice (flag_leaf_traits_rice_id, flag_length, flag_width, purplish_stripes, pubescence, flag_remarkable_features) FROM stdin;
    public          postgres    false    240   ��      F          0    42292    municipality 
   TABLE DATA           j   COPY public.municipality (municipality_id, province_id, municipality_name, municipality_date) FROM stdin;
    public          postgres    false    242   ��      H          0    42297    panicle_traits_rice 
   TABLE DATA           �   COPY public.panicle_traits_rice (panicle_traits_rice_id, panicle_length, panicle_width, panicle_enclosed_by, panicle_remarkable_features) FROM stdin;
    public          postgres    false    244   m�      J          0    42303    pest_resistance 
   TABLE DATA           H   COPY public.pest_resistance (pest_resistance_id, pest_name) FROM stdin;
    public          postgres    false    246   ��      L          0    42307    province 
   TABLE DATA           M   COPY public.province (province_id, province_name, province_date) FROM stdin;
    public          postgres    false    248   r�      N          0    42312 
   references 
   TABLE DATA           >   COPY public."references" (references_id, crop_id) FROM stdin;
    public          postgres    false    250   ��      P          0    42316    reproductive_state_corn 
   TABLE DATA           r   COPY public.reproductive_state_corn (reproductive_state_corn_id, corn_yield_capacity, seed_traits_id) FROM stdin;
    public          postgres    false    252   ��      R          0    42320    reproductive_state_rice 
   TABLE DATA           �   COPY public.reproductive_state_rice (reproductive_state_rice_id, rice_yield_capacity, panicle_traits_rice_id, seed_traits_id, flag_leaf_traits_rice_id) FROM stdin;
    public          postgres    false    254   8�      T          0    42324    rice_abiotic_resistance 
   TABLE DATA           q   COPY public.rice_abiotic_resistance (rice_traits_id, abiotic_resistance_id, rice_is_checked_abiotic) FROM stdin;
    public          postgres    false    256   u�      U          0    42327    rice_abiotic_resistance_other 
   TABLE DATA           {   COPY public.rice_abiotic_resistance_other (rice_abiotic_other_id, rice_abiotic_other, rice_abiotic_other_desc) FROM stdin;
    public          postgres    false    257   ��      W          0    42331    rice_disease_resistance 
   TABLE DATA           q   COPY public.rice_disease_resistance (rice_traits_id, disease_resistance_id, rice_is_checked_disease) FROM stdin;
    public          postgres    false    259   ��      X          0    42334    rice_pest_resistance 
   TABLE DATA           h   COPY public.rice_pest_resistance (rice_traits_id, pest_resistance_id, rice_is_checked_pest) FROM stdin;
    public          postgres    false    260   ��      Y          0    42337    rice_pest_resistance_other 
   TABLE DATA           o   COPY public.rice_pest_resistance_other (rice_pest_other_id, rice_pest_other, rice_pest_other_desc) FROM stdin;
    public          postgres    false    261   @�      [          0    42341    rice_traits 
   TABLE DATA           �   COPY public.rice_traits (rice_traits_id, crop_id, vegetative_state_rice_id, reproductive_state_rice_id, sensory_traits_rice_id, rice_pest_other_id, rice_abiotic_other_id) FROM stdin;
    public          postgres    false    263   o�      ]          0    42345    root_crop_traits 
   TABLE DATA           �   COPY public.root_crop_traits (root_crop_traits_id, crop_id, vegetative_state_rootcrop_id, rootcrop_traits_id, rootcrop_pest_other_id, rootcrop_abiotic_other_id) FROM stdin;
    public          postgres    false    265   ��      _          0    42349    rootcrop_abiotic_resistance 
   TABLE DATA           ~   COPY public.rootcrop_abiotic_resistance (root_crop_traits_id, abiotic_resistance_id, rootcrop_is_checked_abiotic) FROM stdin;
    public          postgres    false    267   ��      `          0    42352 !   rootcrop_abiotic_resistance_other 
   TABLE DATA           �   COPY public.rootcrop_abiotic_resistance_other (rootcrop_abiotic_other_id, rootcrop_abiotic_other, rootcrop_abiotic_other_desc) FROM stdin;
    public          postgres    false    268   ��      b          0    42356    rootcrop_disease_resistance 
   TABLE DATA           ~   COPY public.rootcrop_disease_resistance (root_crop_traits_id, disease_resistance_id, rootcrop_is_checked_disease) FROM stdin;
    public          postgres    false    270    �      c          0    42359    rootcrop_pest_resistance 
   TABLE DATA           u   COPY public.rootcrop_pest_resistance (root_crop_traits_id, pest_resistance_id, rootcrop_is_checked_pest) FROM stdin;
    public          postgres    false    271   M�      d          0    42362    rootcrop_pest_resistance_other 
   TABLE DATA              COPY public.rootcrop_pest_resistance_other (rootcrop_pest_other_id, rootcrop_pest_other, rootcrop_pest_other_desc) FROM stdin;
    public          postgres    false    272   ��      f          0    42366    rootcrop_traits 
   TABLE DATA           �   COPY public.rootcrop_traits (rootcrop_traits_id, eating_quality, rootcrop_color, sweetness, rootcrop_remarkable_features) FROM stdin;
    public          postgres    false    274   ��      h          0    42372    seed_traits 
   TABLE DATA           f   COPY public.seed_traits (seed_traits_id, seed_length, seed_width, seed_shape, seed_color) FROM stdin;
    public          postgres    false    276   ��      j          0    42378    sensory_traits_rice 
   TABLE DATA           �   COPY public.sensory_traits_rice (sensory_traits_rice_id, aroma, quality_cooked_rice, quality_leftover_rice, volume_expansion, glutinous, hardness) FROM stdin;
    public          postgres    false    278   C�      l          0    42384    status 
   TABLE DATA           I   COPY public.status (status_id, status_date, remarks, action) FROM stdin;
    public          postgres    false    280   v�      n          0    42390    terrain 
   TABLE DATA           ;   COPY public.terrain (terrain_id, terrain_name) FROM stdin;
    public          postgres    false    282   ��      p          0    42394    users 
   TABLE DATA           �   COPY public.users (user_id, first_name, last_name, gender, email, password, affiliation, username, email_verified, account_type_id, registration_date) FROM stdin;
    public          postgres    false    284   ��      r          0    42400    utilization_cultural_importance 
   TABLE DATA           �   COPY public.utilization_cultural_importance (utilization_cultural_id, significance, use, indigenous_utilization, remarkable_features) FROM stdin;
    public          postgres    false    286   ��      t          0    42406    vegetative_state_corn 
   TABLE DATA           �   COPY public.vegetative_state_corn (vegetative_state_corn_id, corn_plant_height, corn_leaf_width, corn_leaf_length, corn_maturity_time) FROM stdin;
    public          postgres    false    288   �      v          0    42412    vegetative_state_rice 
   TABLE DATA           �   COPY public.vegetative_state_rice (vegetative_state_rice_id, rice_plant_height, rice_leaf_width, rice_leaf_length, rice_tillering_ability, rice_maturity_time) FROM stdin;
    public          postgres    false    290   y�      x          0    42418    vegetative_state_rootcrop 
   TABLE DATA           �   COPY public.vegetative_state_rootcrop (vegetative_state_rootcrop_id, rootcrop_plant_height, rootcrop_leaf_width, rootcrop_leaf_length, rootcrop_stem_leaf_desc, rootcrop_maturity_time) FROM stdin;
    public          postgres    false    292   ��      �           0    0 ,   abiotic_resistance_abiotic_resistance_id_seq    SEQUENCE SET     Z   SELECT pg_catalog.setval('public.abiotic_resistance_abiotic_resistance_id_seq', 4, true);
          public          postgres    false    216            �           0    0     account_type_account_type_id_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.account_type_account_type_id_seq', 1, false);
          public          postgres    false    218            �           0    0    barangay_barangay_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.barangay_barangay_id_seq', 36, true);
          public          postgres    false    220            �           0    0    category_category_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.category_category_id_seq', 8, true);
          public          postgres    false    222            �           0    0 (   category_variety_category_variety_id_seq    SEQUENCE SET     V   SELECT pg_catalog.setval('public.category_variety_category_variety_id_seq', 8, true);
          public          postgres    false    224            �           0    0 7   corn_abiotic_resistance_other_corn_abiotic_other_id_seq    SEQUENCE SET     f   SELECT pg_catalog.setval('public.corn_abiotic_resistance_other_corn_abiotic_other_id_seq', 15, true);
          public          postgres    false    227            �           0    0 1   corn_pest_resistance_other_corn_pest_other_id_seq    SEQUENCE SET     `   SELECT pg_catalog.setval('public.corn_pest_resistance_other_corn_pest_other_id_seq', 16, true);
          public          postgres    false    231            �           0    0    corn_traits_corn_traits_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.corn_traits_corn_traits_id_seq', 20, true);
          public          postgres    false    233            �           0    0    crop_crop_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.crop_crop_id_seq', 39, true);
          public          postgres    false    235            �           0    0 "   crop_location_crop_location_id_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.crop_location_crop_location_id_seq', 34, true);
          public          postgres    false    237            �           0    0 ,   disease_resistance_disease_resistance_id_seq    SEQUENCE SET     Z   SELECT pg_catalog.setval('public.disease_resistance_disease_resistance_id_seq', 3, true);
          public          postgres    false    239            �           0    0 2   flag_leaf_traits_rice_flag_leaf_traits_rice_id_seq    SEQUENCE SET     `   SELECT pg_catalog.setval('public.flag_leaf_traits_rice_flag_leaf_traits_rice_id_seq', 5, true);
          public          postgres    false    241            �           0    0     municipality_municipality_id_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('public.municipality_municipality_id_seq', 8, true);
          public          postgres    false    243            �           0    0 .   panicle_traits_rice_panicle_traits_rice_id_seq    SEQUENCE SET     \   SELECT pg_catalog.setval('public.panicle_traits_rice_panicle_traits_rice_id_seq', 5, true);
          public          postgres    false    245            �           0    0 &   pest_resistance_pest_resistance_id_seq    SEQUENCE SET     U   SELECT pg_catalog.setval('public.pest_resistance_pest_resistance_id_seq', 20, true);
          public          postgres    false    247            �           0    0    province_province_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.province_province_id_seq', 1, true);
          public          postgres    false    249            �           0    0    references_references_id_seq    SEQUENCE SET     K   SELECT pg_catalog.setval('public.references_references_id_seq', 1, false);
          public          postgres    false    251            �           0    0 6   reproductive_state_corn_reproductive_state_corn_id_seq    SEQUENCE SET     e   SELECT pg_catalog.setval('public.reproductive_state_corn_reproductive_state_corn_id_seq', 22, true);
          public          postgres    false    253            �           0    0 6   reproductive_state_rice_reproductive_state_rice_id_seq    SEQUENCE SET     d   SELECT pg_catalog.setval('public.reproductive_state_rice_reproductive_state_rice_id_seq', 5, true);
          public          postgres    false    255            �           0    0 7   rice_abiotic_resistance_other_rice_abiotic_other_id_seq    SEQUENCE SET     e   SELECT pg_catalog.setval('public.rice_abiotic_resistance_other_rice_abiotic_other_id_seq', 6, true);
          public          postgres    false    258            �           0    0 1   rice_pest_resistance_other_rice_pest_other_id_seq    SEQUENCE SET     _   SELECT pg_catalog.setval('public.rice_pest_resistance_other_rice_pest_other_id_seq', 6, true);
          public          postgres    false    262            �           0    0    rice_traits_rice_traits_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.rice_traits_rice_traits_id_seq', 5, true);
          public          postgres    false    264            �           0    0 (   root_crop_traits_root_crop_traits_id_seq    SEQUENCE SET     V   SELECT pg_catalog.setval('public.root_crop_traits_root_crop_traits_id_seq', 6, true);
          public          postgres    false    266            �           0    0 ?   rootcrop_abiotic_resistance_othe_root_crop_abiotic_other_id_seq    SEQUENCE SET     m   SELECT pg_catalog.setval('public.rootcrop_abiotic_resistance_othe_root_crop_abiotic_other_id_seq', 7, true);
          public          postgres    false    269            �           0    0 :   rootcrop_pest_resistance_other_root_crop_pest_other_id_seq    SEQUENCE SET     h   SELECT pg_catalog.setval('public.rootcrop_pest_resistance_other_root_crop_pest_other_id_seq', 7, true);
          public          postgres    false    273            �           0    0 &   rootcrop_traits_rootcrop_traits_id_seq    SEQUENCE SET     T   SELECT pg_catalog.setval('public.rootcrop_traits_rootcrop_traits_id_seq', 7, true);
          public          postgres    false    275            �           0    0    seed_traits_seed_traits_id_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.seed_traits_seed_traits_id_seq', 27, true);
          public          postgres    false    277            �           0    0 .   sensory_traits_rice_sensory_traits_rice_id_seq    SEQUENCE SET     \   SELECT pg_catalog.setval('public.sensory_traits_rice_sensory_traits_rice_id_seq', 5, true);
          public          postgres    false    279            �           0    0    status_status_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.status_status_id_seq', 41, true);
          public          postgres    false    281            �           0    0    terrain_terrain_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.terrain_terrain_id_seq', 5, true);
          public          postgres    false    283            �           0    0    users_user_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.users_user_id_seq', 5, true);
          public          postgres    false    285            �           0    0 <   utilization_cultural_importance_utillization_cultural_id_seq    SEQUENCE SET     k   SELECT pg_catalog.setval('public.utilization_cultural_importance_utillization_cultural_id_seq', 41, true);
          public          postgres    false    287            �           0    0 2   vegetative_state_corn_vegetative_state_corn_id_seq    SEQUENCE SET     a   SELECT pg_catalog.setval('public.vegetative_state_corn_vegetative_state_corn_id_seq', 22, true);
          public          postgres    false    289            �           0    0 2   vegetative_state_rice_vegetative_state_rice_id_seq    SEQUENCE SET     `   SELECT pg_catalog.setval('public.vegetative_state_rice_vegetative_state_rice_id_seq', 5, true);
          public          postgres    false    291            �           0    0 :   vegetative_state_rootcrop_vegetative_state_rootcrop_id_seq    SEQUENCE SET     h   SELECT pg_catalog.setval('public.vegetative_state_rootcrop_vegetative_state_rootcrop_id_seq', 7, true);
          public          postgres    false    293                       2606    42460 *   abiotic_resistance abiotic_resistance_pkey 
   CONSTRAINT     {   ALTER TABLE ONLY public.abiotic_resistance
    ADD CONSTRAINT abiotic_resistance_pkey PRIMARY KEY (abiotic_resistance_id);
 T   ALTER TABLE ONLY public.abiotic_resistance DROP CONSTRAINT abiotic_resistance_pkey;
       public            postgres    false    215                       2606    42462    account_type account_type_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.account_type
    ADD CONSTRAINT account_type_pkey PRIMARY KEY (account_type_id);
 H   ALTER TABLE ONLY public.account_type DROP CONSTRAINT account_type_pkey;
       public            postgres    false    217                       2606    42464    barangay barangay_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.barangay
    ADD CONSTRAINT barangay_pkey PRIMARY KEY (barangay_id);
 @   ALTER TABLE ONLY public.barangay DROP CONSTRAINT barangay_pkey;
       public            postgres    false    219                       2606    42466    category category_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (category_id);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public            postgres    false    221                       2606    42468 &   category_variety category_variety_pkey 
   CONSTRAINT     u   ALTER TABLE ONLY public.category_variety
    ADD CONSTRAINT category_variety_pkey PRIMARY KEY (category_variety_id);
 P   ALTER TABLE ONLY public.category_variety DROP CONSTRAINT category_variety_pkey;
       public            postgres    false    223                       2606    42470 @   corn_abiotic_resistance_other corn_abiotic_resistance_other_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.corn_abiotic_resistance_other
    ADD CONSTRAINT corn_abiotic_resistance_other_pkey PRIMARY KEY (corn_abiotic_other_id);
 j   ALTER TABLE ONLY public.corn_abiotic_resistance_other DROP CONSTRAINT corn_abiotic_resistance_other_pkey;
       public            postgres    false    226                       2606    42472 4   corn_abiotic_resistance corn_abiotic_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.corn_abiotic_resistance
    ADD CONSTRAINT corn_abiotic_resistance_pkey PRIMARY KEY (corn_traits_id, abiotic_resistance_id);
 ^   ALTER TABLE ONLY public.corn_abiotic_resistance DROP CONSTRAINT corn_abiotic_resistance_pkey;
       public            postgres    false    225    225                       2606    42474 4   corn_disease_resistance corn_disease_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.corn_disease_resistance
    ADD CONSTRAINT corn_disease_resistance_pkey PRIMARY KEY (corn_traits_id, disease_resistance_id);
 ^   ALTER TABLE ONLY public.corn_disease_resistance DROP CONSTRAINT corn_disease_resistance_pkey;
       public            postgres    false    228    228            #           2606    42476 :   corn_pest_resistance_other corn_pest_resistance_other_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.corn_pest_resistance_other
    ADD CONSTRAINT corn_pest_resistance_other_pkey PRIMARY KEY (corn_pest_other_id);
 d   ALTER TABLE ONLY public.corn_pest_resistance_other DROP CONSTRAINT corn_pest_resistance_other_pkey;
       public            postgres    false    230            !           2606    42478 .   corn_pest_resistance corn_pest_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.corn_pest_resistance
    ADD CONSTRAINT corn_pest_resistance_pkey PRIMARY KEY (corn_traits_id, pest_resistance_id);
 X   ALTER TABLE ONLY public.corn_pest_resistance DROP CONSTRAINT corn_pest_resistance_pkey;
       public            postgres    false    229    229            %           2606    42480    corn_traits corn_traits_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.corn_traits
    ADD CONSTRAINT corn_traits_pkey PRIMARY KEY (corn_traits_id);
 F   ALTER TABLE ONLY public.corn_traits DROP CONSTRAINT corn_traits_pkey;
       public            postgres    false    232            )           2606    42482     crop_location crop_location_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.crop_location
    ADD CONSTRAINT crop_location_pkey PRIMARY KEY (crop_location_id);
 J   ALTER TABLE ONLY public.crop_location DROP CONSTRAINT crop_location_pkey;
       public            postgres    false    236            '           2606    42484    crop crop_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.crop
    ADD CONSTRAINT crop_pkey PRIMARY KEY (crop_id);
 8   ALTER TABLE ONLY public.crop DROP CONSTRAINT crop_pkey;
       public            postgres    false    234            +           2606    42486 *   disease_resistance disease_resistance_pkey 
   CONSTRAINT     {   ALTER TABLE ONLY public.disease_resistance
    ADD CONSTRAINT disease_resistance_pkey PRIMARY KEY (disease_resistance_id);
 T   ALTER TABLE ONLY public.disease_resistance DROP CONSTRAINT disease_resistance_pkey;
       public            postgres    false    238            -           2606    42488 0   flag_leaf_traits_rice flag_leaf_traits_rice_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.flag_leaf_traits_rice
    ADD CONSTRAINT flag_leaf_traits_rice_pkey PRIMARY KEY (flag_leaf_traits_rice_id);
 Z   ALTER TABLE ONLY public.flag_leaf_traits_rice DROP CONSTRAINT flag_leaf_traits_rice_pkey;
       public            postgres    false    240            /           2606    42490    municipality municipality_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.municipality
    ADD CONSTRAINT municipality_pkey PRIMARY KEY (municipality_id);
 H   ALTER TABLE ONLY public.municipality DROP CONSTRAINT municipality_pkey;
       public            postgres    false    242            1           2606    42492 ,   panicle_traits_rice panicle_traits_rice_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.panicle_traits_rice
    ADD CONSTRAINT panicle_traits_rice_pkey PRIMARY KEY (panicle_traits_rice_id);
 V   ALTER TABLE ONLY public.panicle_traits_rice DROP CONSTRAINT panicle_traits_rice_pkey;
       public            postgres    false    244            3           2606    42494 $   pest_resistance pest_resistance_pkey 
   CONSTRAINT     r   ALTER TABLE ONLY public.pest_resistance
    ADD CONSTRAINT pest_resistance_pkey PRIMARY KEY (pest_resistance_id);
 N   ALTER TABLE ONLY public.pest_resistance DROP CONSTRAINT pest_resistance_pkey;
       public            postgres    false    246            5           2606    42496    province province_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.province
    ADD CONSTRAINT province_pkey PRIMARY KEY (province_id);
 @   ALTER TABLE ONLY public.province DROP CONSTRAINT province_pkey;
       public            postgres    false    248            7           2606    42498    references references_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY public."references"
    ADD CONSTRAINT references_pkey PRIMARY KEY (references_id);
 F   ALTER TABLE ONLY public."references" DROP CONSTRAINT references_pkey;
       public            postgres    false    250            9           2606    42500 4   reproductive_state_corn reproductive_state_corn_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.reproductive_state_corn
    ADD CONSTRAINT reproductive_state_corn_pkey PRIMARY KEY (reproductive_state_corn_id);
 ^   ALTER TABLE ONLY public.reproductive_state_corn DROP CONSTRAINT reproductive_state_corn_pkey;
       public            postgres    false    252            ;           2606    42502 4   reproductive_state_rice reproductive_state_rice_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.reproductive_state_rice
    ADD CONSTRAINT reproductive_state_rice_pkey PRIMARY KEY (reproductive_state_rice_id);
 ^   ALTER TABLE ONLY public.reproductive_state_rice DROP CONSTRAINT reproductive_state_rice_pkey;
       public            postgres    false    254            ?           2606    42504 @   rice_abiotic_resistance_other rice_abiotic_resistance_other_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rice_abiotic_resistance_other
    ADD CONSTRAINT rice_abiotic_resistance_other_pkey PRIMARY KEY (rice_abiotic_other_id);
 j   ALTER TABLE ONLY public.rice_abiotic_resistance_other DROP CONSTRAINT rice_abiotic_resistance_other_pkey;
       public            postgres    false    257            =           2606    42506 4   rice_abiotic_resistance rice_abiotic_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rice_abiotic_resistance
    ADD CONSTRAINT rice_abiotic_resistance_pkey PRIMARY KEY (rice_traits_id, abiotic_resistance_id);
 ^   ALTER TABLE ONLY public.rice_abiotic_resistance DROP CONSTRAINT rice_abiotic_resistance_pkey;
       public            postgres    false    256    256            A           2606    42508 4   rice_disease_resistance rice_disease_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rice_disease_resistance
    ADD CONSTRAINT rice_disease_resistance_pkey PRIMARY KEY (rice_traits_id, disease_resistance_id);
 ^   ALTER TABLE ONLY public.rice_disease_resistance DROP CONSTRAINT rice_disease_resistance_pkey;
       public            postgres    false    259    259            E           2606    42510 :   rice_pest_resistance_other rice_pest_resistance_other_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rice_pest_resistance_other
    ADD CONSTRAINT rice_pest_resistance_other_pkey PRIMARY KEY (rice_pest_other_id);
 d   ALTER TABLE ONLY public.rice_pest_resistance_other DROP CONSTRAINT rice_pest_resistance_other_pkey;
       public            postgres    false    261            C           2606    42512 .   rice_pest_resistance rice_pest_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rice_pest_resistance
    ADD CONSTRAINT rice_pest_resistance_pkey PRIMARY KEY (rice_traits_id, pest_resistance_id);
 X   ALTER TABLE ONLY public.rice_pest_resistance DROP CONSTRAINT rice_pest_resistance_pkey;
       public            postgres    false    260    260            G           2606    42514    rice_traits rice_traits_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.rice_traits
    ADD CONSTRAINT rice_traits_pkey PRIMARY KEY (rice_traits_id);
 F   ALTER TABLE ONLY public.rice_traits DROP CONSTRAINT rice_traits_pkey;
       public            postgres    false    263            I           2606    42516 &   root_crop_traits root_crop_traits_pkey 
   CONSTRAINT     u   ALTER TABLE ONLY public.root_crop_traits
    ADD CONSTRAINT root_crop_traits_pkey PRIMARY KEY (root_crop_traits_id);
 P   ALTER TABLE ONLY public.root_crop_traits DROP CONSTRAINT root_crop_traits_pkey;
       public            postgres    false    265            M           2606    42518 H   rootcrop_abiotic_resistance_other rootcrop_abiotic_resistance_other_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_abiotic_resistance_other
    ADD CONSTRAINT rootcrop_abiotic_resistance_other_pkey PRIMARY KEY (rootcrop_abiotic_other_id);
 r   ALTER TABLE ONLY public.rootcrop_abiotic_resistance_other DROP CONSTRAINT rootcrop_abiotic_resistance_other_pkey;
       public            postgres    false    268            K           2606    42520 <   rootcrop_abiotic_resistance rootcrop_abiotic_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_abiotic_resistance
    ADD CONSTRAINT rootcrop_abiotic_resistance_pkey PRIMARY KEY (root_crop_traits_id, abiotic_resistance_id);
 f   ALTER TABLE ONLY public.rootcrop_abiotic_resistance DROP CONSTRAINT rootcrop_abiotic_resistance_pkey;
       public            postgres    false    267    267            O           2606    42522 <   rootcrop_disease_resistance rootcrop_disease_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_disease_resistance
    ADD CONSTRAINT rootcrop_disease_resistance_pkey PRIMARY KEY (root_crop_traits_id, disease_resistance_id);
 f   ALTER TABLE ONLY public.rootcrop_disease_resistance DROP CONSTRAINT rootcrop_disease_resistance_pkey;
       public            postgres    false    270    270            S           2606    42524 B   rootcrop_pest_resistance_other rootcrop_pest_resistance_other_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_pest_resistance_other
    ADD CONSTRAINT rootcrop_pest_resistance_other_pkey PRIMARY KEY (rootcrop_pest_other_id);
 l   ALTER TABLE ONLY public.rootcrop_pest_resistance_other DROP CONSTRAINT rootcrop_pest_resistance_other_pkey;
       public            postgres    false    272            Q           2606    42526 6   rootcrop_pest_resistance rootcrop_pest_resistance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_pest_resistance
    ADD CONSTRAINT rootcrop_pest_resistance_pkey PRIMARY KEY (root_crop_traits_id, pest_resistance_id);
 `   ALTER TABLE ONLY public.rootcrop_pest_resistance DROP CONSTRAINT rootcrop_pest_resistance_pkey;
       public            postgres    false    271    271            U           2606    42528 $   rootcrop_traits rootcrop_traits_pkey 
   CONSTRAINT     r   ALTER TABLE ONLY public.rootcrop_traits
    ADD CONSTRAINT rootcrop_traits_pkey PRIMARY KEY (rootcrop_traits_id);
 N   ALTER TABLE ONLY public.rootcrop_traits DROP CONSTRAINT rootcrop_traits_pkey;
       public            postgres    false    274            W           2606    42530    seed_traits seed_traits_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.seed_traits
    ADD CONSTRAINT seed_traits_pkey PRIMARY KEY (seed_traits_id);
 F   ALTER TABLE ONLY public.seed_traits DROP CONSTRAINT seed_traits_pkey;
       public            postgres    false    276            Y           2606    42532 ,   sensory_traits_rice sensory_traits_rice_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.sensory_traits_rice
    ADD CONSTRAINT sensory_traits_rice_pkey PRIMARY KEY (sensory_traits_rice_id);
 V   ALTER TABLE ONLY public.sensory_traits_rice DROP CONSTRAINT sensory_traits_rice_pkey;
       public            postgres    false    278            [           2606    42534    status status_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.status
    ADD CONSTRAINT status_pkey PRIMARY KEY (status_id);
 <   ALTER TABLE ONLY public.status DROP CONSTRAINT status_pkey;
       public            postgres    false    280            ]           2606    42536    terrain terrain_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.terrain
    ADD CONSTRAINT terrain_pkey PRIMARY KEY (terrain_id);
 >   ALTER TABLE ONLY public.terrain DROP CONSTRAINT terrain_pkey;
       public            postgres    false    282            _           2606    42538    users users_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    284            a           2606    42540 D   utilization_cultural_importance utilization_cultural_importance_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.utilization_cultural_importance
    ADD CONSTRAINT utilization_cultural_importance_pkey PRIMARY KEY (utilization_cultural_id);
 n   ALTER TABLE ONLY public.utilization_cultural_importance DROP CONSTRAINT utilization_cultural_importance_pkey;
       public            postgres    false    286            c           2606    42542 0   vegetative_state_corn vegetative_state_corn_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.vegetative_state_corn
    ADD CONSTRAINT vegetative_state_corn_pkey PRIMARY KEY (vegetative_state_corn_id);
 Z   ALTER TABLE ONLY public.vegetative_state_corn DROP CONSTRAINT vegetative_state_corn_pkey;
       public            postgres    false    288            e           2606    42544 0   vegetative_state_rice vegetative_state_rice_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.vegetative_state_rice
    ADD CONSTRAINT vegetative_state_rice_pkey PRIMARY KEY (vegetative_state_rice_id);
 Z   ALTER TABLE ONLY public.vegetative_state_rice DROP CONSTRAINT vegetative_state_rice_pkey;
       public            postgres    false    290            g           2606    42546 8   vegetative_state_rootcrop vegetative_state_rootcrop_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.vegetative_state_rootcrop
    ADD CONSTRAINT vegetative_state_rootcrop_pkey PRIMARY KEY (vegetative_state_rootcrop_id);
 b   ALTER TABLE ONLY public.vegetative_state_rootcrop DROP CONSTRAINT vegetative_state_rootcrop_pkey;
       public            postgres    false    292            h           2606    42871 &   barangay barangay_municipality_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.barangay
    ADD CONSTRAINT barangay_municipality_id_fkey FOREIGN KEY (municipality_id) REFERENCES public.municipality(municipality_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 P   ALTER TABLE ONLY public.barangay DROP CONSTRAINT barangay_municipality_id_fkey;
       public          postgres    false    219    242    4911            i           2606    42861 2   category_variety category_variety_category_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.category_variety
    ADD CONSTRAINT category_variety_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.category(category_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 \   ALTER TABLE ONLY public.category_variety DROP CONSTRAINT category_variety_category_id_fkey;
       public          postgres    false    221    223    4887            j           2606    42901 J   corn_abiotic_resistance corn_abiotic_resistance_abiotic_resistance_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_abiotic_resistance
    ADD CONSTRAINT corn_abiotic_resistance_abiotic_resistance_id_fkey FOREIGN KEY (abiotic_resistance_id) REFERENCES public.abiotic_resistance(abiotic_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 t   ALTER TABLE ONLY public.corn_abiotic_resistance DROP CONSTRAINT corn_abiotic_resistance_abiotic_resistance_id_fkey;
       public          postgres    false    4881    225    215            k           2606    42906 C   corn_abiotic_resistance corn_abiotic_resistance_corn_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_abiotic_resistance
    ADD CONSTRAINT corn_abiotic_resistance_corn_traits_id_fkey FOREIGN KEY (corn_traits_id) REFERENCES public.corn_traits(corn_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 m   ALTER TABLE ONLY public.corn_abiotic_resistance DROP CONSTRAINT corn_abiotic_resistance_corn_traits_id_fkey;
       public          postgres    false    232    225    4901            l           2606    42911 C   corn_disease_resistance corn_disease_resistance_corn_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_disease_resistance
    ADD CONSTRAINT corn_disease_resistance_corn_traits_id_fkey FOREIGN KEY (corn_traits_id) REFERENCES public.corn_traits(corn_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 m   ALTER TABLE ONLY public.corn_disease_resistance DROP CONSTRAINT corn_disease_resistance_corn_traits_id_fkey;
       public          postgres    false    232    228    4901            m           2606    42916 J   corn_disease_resistance corn_disease_resistance_disease_resistance_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_disease_resistance
    ADD CONSTRAINT corn_disease_resistance_disease_resistance_id_fkey FOREIGN KEY (disease_resistance_id) REFERENCES public.disease_resistance(disease_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 t   ALTER TABLE ONLY public.corn_disease_resistance DROP CONSTRAINT corn_disease_resistance_disease_resistance_id_fkey;
       public          postgres    false    4907    228    238            n           2606    42921 =   corn_pest_resistance corn_pest_resistance_corn_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_pest_resistance
    ADD CONSTRAINT corn_pest_resistance_corn_traits_id_fkey FOREIGN KEY (corn_traits_id) REFERENCES public.corn_traits(corn_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 g   ALTER TABLE ONLY public.corn_pest_resistance DROP CONSTRAINT corn_pest_resistance_corn_traits_id_fkey;
       public          postgres    false    4901    229    232            o           2606    42926 A   corn_pest_resistance corn_pest_resistance_pest_resistance_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_pest_resistance
    ADD CONSTRAINT corn_pest_resistance_pest_resistance_id_fkey FOREIGN KEY (pest_resistance_id) REFERENCES public.pest_resistance(pest_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 k   ALTER TABLE ONLY public.corn_pest_resistance DROP CONSTRAINT corn_pest_resistance_pest_resistance_id_fkey;
       public          postgres    false    246    4915    229            p           2606    42876 2   corn_traits corn_traits_corn_abiotic_other_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_traits
    ADD CONSTRAINT corn_traits_corn_abiotic_other_id_fkey FOREIGN KEY (corn_abiotic_other_id) REFERENCES public.corn_abiotic_resistance_other(corn_abiotic_other_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 \   ALTER TABLE ONLY public.corn_traits DROP CONSTRAINT corn_traits_corn_abiotic_other_id_fkey;
       public          postgres    false    226    232    4893            q           2606    42881 /   corn_traits corn_traits_corn_pest_other_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_traits
    ADD CONSTRAINT corn_traits_corn_pest_other_id_fkey FOREIGN KEY (corn_pest_other_id) REFERENCES public.corn_pest_resistance_other(corn_pest_other_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 Y   ALTER TABLE ONLY public.corn_traits DROP CONSTRAINT corn_traits_corn_pest_other_id_fkey;
       public          postgres    false    230    4899    232            r           2606    42886 $   corn_traits corn_traits_crop_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_traits
    ADD CONSTRAINT corn_traits_crop_id_fkey FOREIGN KEY (crop_id) REFERENCES public.crop(crop_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 N   ALTER TABLE ONLY public.corn_traits DROP CONSTRAINT corn_traits_crop_id_fkey;
       public          postgres    false    232    4903    234            s           2606    42891 7   corn_traits corn_traits_reproductive_state_corn_id_fkey    FK CONSTRAINT       ALTER TABLE ONLY public.corn_traits
    ADD CONSTRAINT corn_traits_reproductive_state_corn_id_fkey FOREIGN KEY (reproductive_state_corn_id) REFERENCES public.reproductive_state_corn(reproductive_state_corn_id) ON UPDATE RESTRICT ON DELETE CASCADE NOT VALID;
 a   ALTER TABLE ONLY public.corn_traits DROP CONSTRAINT corn_traits_reproductive_state_corn_id_fkey;
       public          postgres    false    4921    232    252            t           2606    42896 5   corn_traits corn_traits_vegetative_state_corn_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.corn_traits
    ADD CONSTRAINT corn_traits_vegetative_state_corn_id_fkey FOREIGN KEY (vegetative_state_corn_id) REFERENCES public.vegetative_state_corn(vegetative_state_corn_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 _   ALTER TABLE ONLY public.corn_traits DROP CONSTRAINT corn_traits_vegetative_state_corn_id_fkey;
       public          postgres    false    4963    232    288            u           2606    42811    crop crop_category_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop
    ADD CONSTRAINT crop_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.category(category_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 D   ALTER TABLE ONLY public.crop DROP CONSTRAINT crop_category_id_fkey;
       public          postgres    false    4887    221    234            v           2606    42821 "   crop crop_category_variety_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop
    ADD CONSTRAINT crop_category_variety_id_fkey FOREIGN KEY (category_variety_id) REFERENCES public.category_variety(category_variety_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 L   ALTER TABLE ONLY public.crop DROP CONSTRAINT crop_category_variety_id_fkey;
       public          postgres    false    4889    234    223            {           2606    42841 ,   crop_location crop_location_barangay_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop_location
    ADD CONSTRAINT crop_location_barangay_id_fkey FOREIGN KEY (barangay_id) REFERENCES public.barangay(barangay_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 V   ALTER TABLE ONLY public.crop_location DROP CONSTRAINT crop_location_barangay_id_fkey;
       public          postgres    false    4885    236    219            |           2606    42846 (   crop_location crop_location_crop_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop_location
    ADD CONSTRAINT crop_location_crop_id_fkey FOREIGN KEY (crop_id) REFERENCES public.crop(crop_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 R   ALTER TABLE ONLY public.crop_location DROP CONSTRAINT crop_location_crop_id_fkey;
       public          postgres    false    234    4903    236            }           2606    42851 0   crop_location crop_location_municipality_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop_location
    ADD CONSTRAINT crop_location_municipality_id_fkey FOREIGN KEY (municipality_id) REFERENCES public.municipality(municipality_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 Z   ALTER TABLE ONLY public.crop_location DROP CONSTRAINT crop_location_municipality_id_fkey;
       public          postgres    false    242    4911    236            w           2606    42816    crop crop_status_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop
    ADD CONSTRAINT crop_status_id_fkey FOREIGN KEY (status_id) REFERENCES public.status(status_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 B   ALTER TABLE ONLY public.crop DROP CONSTRAINT crop_status_id_fkey;
       public          postgres    false    234    4955    280            x           2606    42826    crop crop_terrain_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop
    ADD CONSTRAINT crop_terrain_id_fkey FOREIGN KEY (terrain_id) REFERENCES public.terrain(terrain_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 C   ALTER TABLE ONLY public.crop DROP CONSTRAINT crop_terrain_id_fkey;
       public          postgres    false    234    4957    282            y           2606    42831    crop crop_user_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop
    ADD CONSTRAINT crop_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 @   ALTER TABLE ONLY public.crop DROP CONSTRAINT crop_user_id_fkey;
       public          postgres    false    4959    234    284            z           2606    42836 &   crop crop_utilization_cultural_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.crop
    ADD CONSTRAINT crop_utilization_cultural_id_fkey FOREIGN KEY (utilization_cultural_id) REFERENCES public.utilization_cultural_importance(utilization_cultural_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 P   ALTER TABLE ONLY public.crop DROP CONSTRAINT crop_utilization_cultural_id_fkey;
       public          postgres    false    234    4961    286            ~           2606    42866 *   municipality municipality_province_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.municipality
    ADD CONSTRAINT municipality_province_id_fkey FOREIGN KEY (province_id) REFERENCES public.province(province_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 T   ALTER TABLE ONLY public.municipality DROP CONSTRAINT municipality_province_id_fkey;
       public          postgres    false    4917    248    242                       2606    42856 "   references references_crop_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public."references"
    ADD CONSTRAINT references_crop_id_fkey FOREIGN KEY (crop_id) REFERENCES public.crop(crop_id) ON UPDATE RESTRICT ON DELETE CASCADE NOT VALID;
 N   ALTER TABLE ONLY public."references" DROP CONSTRAINT references_crop_id_fkey;
       public          postgres    false    4903    234    250            �           2606    42931 C   reproductive_state_corn reproductive_state_corn_seed_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reproductive_state_corn
    ADD CONSTRAINT reproductive_state_corn_seed_traits_id_fkey FOREIGN KEY (seed_traits_id) REFERENCES public.seed_traits(seed_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 m   ALTER TABLE ONLY public.reproductive_state_corn DROP CONSTRAINT reproductive_state_corn_seed_traits_id_fkey;
       public          postgres    false    4951    276    252            �           2606    42936 M   reproductive_state_rice reproductive_state_rice_flag_leaf_traits_rice_id_fkey    FK CONSTRAINT       ALTER TABLE ONLY public.reproductive_state_rice
    ADD CONSTRAINT reproductive_state_rice_flag_leaf_traits_rice_id_fkey FOREIGN KEY (flag_leaf_traits_rice_id) REFERENCES public.flag_leaf_traits_rice(flag_leaf_traits_rice_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 w   ALTER TABLE ONLY public.reproductive_state_rice DROP CONSTRAINT reproductive_state_rice_flag_leaf_traits_rice_id_fkey;
       public          postgres    false    240    4909    254            �           2606    42941 K   reproductive_state_rice reproductive_state_rice_panicle_traits_rice_id_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.reproductive_state_rice
    ADD CONSTRAINT reproductive_state_rice_panicle_traits_rice_id_fkey FOREIGN KEY (panicle_traits_rice_id) REFERENCES public.panicle_traits_rice(panicle_traits_rice_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 u   ALTER TABLE ONLY public.reproductive_state_rice DROP CONSTRAINT reproductive_state_rice_panicle_traits_rice_id_fkey;
       public          postgres    false    4913    254    244            �           2606    42946 C   reproductive_state_rice reproductive_state_rice_seed_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.reproductive_state_rice
    ADD CONSTRAINT reproductive_state_rice_seed_traits_id_fkey FOREIGN KEY (seed_traits_id) REFERENCES public.seed_traits(seed_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 m   ALTER TABLE ONLY public.reproductive_state_rice DROP CONSTRAINT reproductive_state_rice_seed_traits_id_fkey;
       public          postgres    false    4951    254    276            �           2606    42951 J   rice_abiotic_resistance rice_abiotic_resistance_abiotic_resistance_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_abiotic_resistance
    ADD CONSTRAINT rice_abiotic_resistance_abiotic_resistance_id_fkey FOREIGN KEY (abiotic_resistance_id) REFERENCES public.abiotic_resistance(abiotic_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 t   ALTER TABLE ONLY public.rice_abiotic_resistance DROP CONSTRAINT rice_abiotic_resistance_abiotic_resistance_id_fkey;
       public          postgres    false    256    215    4881            �           2606    42956 C   rice_abiotic_resistance rice_abiotic_resistance_rice_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_abiotic_resistance
    ADD CONSTRAINT rice_abiotic_resistance_rice_traits_id_fkey FOREIGN KEY (rice_traits_id) REFERENCES public.rice_traits(rice_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 m   ALTER TABLE ONLY public.rice_abiotic_resistance DROP CONSTRAINT rice_abiotic_resistance_rice_traits_id_fkey;
       public          postgres    false    4935    256    263            �           2606    42961 J   rice_disease_resistance rice_disease_resistance_disease_resistance_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_disease_resistance
    ADD CONSTRAINT rice_disease_resistance_disease_resistance_id_fkey FOREIGN KEY (disease_resistance_id) REFERENCES public.disease_resistance(disease_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 t   ALTER TABLE ONLY public.rice_disease_resistance DROP CONSTRAINT rice_disease_resistance_disease_resistance_id_fkey;
       public          postgres    false    259    238    4907            �           2606    42966 C   rice_disease_resistance rice_disease_resistance_rice_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_disease_resistance
    ADD CONSTRAINT rice_disease_resistance_rice_traits_id_fkey FOREIGN KEY (rice_traits_id) REFERENCES public.rice_traits(rice_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 m   ALTER TABLE ONLY public.rice_disease_resistance DROP CONSTRAINT rice_disease_resistance_rice_traits_id_fkey;
       public          postgres    false    4935    263    259            �           2606    42971 A   rice_pest_resistance rice_pest_resistance_pest_resistance_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_pest_resistance
    ADD CONSTRAINT rice_pest_resistance_pest_resistance_id_fkey FOREIGN KEY (pest_resistance_id) REFERENCES public.pest_resistance(pest_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 k   ALTER TABLE ONLY public.rice_pest_resistance DROP CONSTRAINT rice_pest_resistance_pest_resistance_id_fkey;
       public          postgres    false    246    260    4915            �           2606    42976 =   rice_pest_resistance rice_pest_resistance_rice_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_pest_resistance
    ADD CONSTRAINT rice_pest_resistance_rice_traits_id_fkey FOREIGN KEY (rice_traits_id) REFERENCES public.rice_traits(rice_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 g   ALTER TABLE ONLY public.rice_pest_resistance DROP CONSTRAINT rice_pest_resistance_rice_traits_id_fkey;
       public          postgres    false    260    4935    263            �           2606    42981 $   rice_traits rice_traits_crop_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_traits
    ADD CONSTRAINT rice_traits_crop_id_fkey FOREIGN KEY (crop_id) REFERENCES public.crop(crop_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 N   ALTER TABLE ONLY public.rice_traits DROP CONSTRAINT rice_traits_crop_id_fkey;
       public          postgres    false    234    4903    263            �           2606    42986 7   rice_traits rice_traits_reproductive_state_rice_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_traits
    ADD CONSTRAINT rice_traits_reproductive_state_rice_id_fkey FOREIGN KEY (reproductive_state_rice_id) REFERENCES public.reproductive_state_rice(reproductive_state_rice_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 a   ALTER TABLE ONLY public.rice_traits DROP CONSTRAINT rice_traits_reproductive_state_rice_id_fkey;
       public          postgres    false    263    4923    254            �           2606    42991 2   rice_traits rice_traits_rice_abiotic_other_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_traits
    ADD CONSTRAINT rice_traits_rice_abiotic_other_id_fkey FOREIGN KEY (rice_abiotic_other_id) REFERENCES public.rice_abiotic_resistance_other(rice_abiotic_other_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 \   ALTER TABLE ONLY public.rice_traits DROP CONSTRAINT rice_traits_rice_abiotic_other_id_fkey;
       public          postgres    false    263    4927    257            �           2606    42996 /   rice_traits rice_traits_rice_pest_other_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_traits
    ADD CONSTRAINT rice_traits_rice_pest_other_id_fkey FOREIGN KEY (rice_pest_other_id) REFERENCES public.rice_pest_resistance_other(rice_pest_other_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 Y   ALTER TABLE ONLY public.rice_traits DROP CONSTRAINT rice_traits_rice_pest_other_id_fkey;
       public          postgres    false    261    263    4933            �           2606    43001 3   rice_traits rice_traits_sensory_traits_rice_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_traits
    ADD CONSTRAINT rice_traits_sensory_traits_rice_id_fkey FOREIGN KEY (sensory_traits_rice_id) REFERENCES public.sensory_traits_rice(sensory_traits_rice_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 ]   ALTER TABLE ONLY public.rice_traits DROP CONSTRAINT rice_traits_sensory_traits_rice_id_fkey;
       public          postgres    false    278    263    4953            �           2606    43006 5   rice_traits rice_traits_vegetative_state_rice_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rice_traits
    ADD CONSTRAINT rice_traits_vegetative_state_rice_id_fkey FOREIGN KEY (vegetative_state_rice_id) REFERENCES public.vegetative_state_rice(vegetative_state_rice_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 _   ALTER TABLE ONLY public.rice_traits DROP CONSTRAINT rice_traits_vegetative_state_rice_id_fkey;
       public          postgres    false    4965    263    290            �           2606    43011 .   root_crop_traits root_crop_traits_crop_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.root_crop_traits
    ADD CONSTRAINT root_crop_traits_crop_id_fkey FOREIGN KEY (crop_id) REFERENCES public.crop(crop_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 X   ALTER TABLE ONLY public.root_crop_traits DROP CONSTRAINT root_crop_traits_crop_id_fkey;
       public          postgres    false    234    4903    265            �           2606    43016 @   root_crop_traits root_crop_traits_rootcrop_abiotic_other_id_fkey    FK CONSTRAINT     	  ALTER TABLE ONLY public.root_crop_traits
    ADD CONSTRAINT root_crop_traits_rootcrop_abiotic_other_id_fkey FOREIGN KEY (rootcrop_abiotic_other_id) REFERENCES public.rootcrop_abiotic_resistance_other(rootcrop_abiotic_other_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 j   ALTER TABLE ONLY public.root_crop_traits DROP CONSTRAINT root_crop_traits_rootcrop_abiotic_other_id_fkey;
       public          postgres    false    268    4941    265            �           2606    43021 =   root_crop_traits root_crop_traits_rootcrop_pest_other_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.root_crop_traits
    ADD CONSTRAINT root_crop_traits_rootcrop_pest_other_id_fkey FOREIGN KEY (rootcrop_pest_other_id) REFERENCES public.rootcrop_pest_resistance_other(rootcrop_pest_other_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 g   ALTER TABLE ONLY public.root_crop_traits DROP CONSTRAINT root_crop_traits_rootcrop_pest_other_id_fkey;
       public          postgres    false    4947    265    272            �           2606    43026 9   root_crop_traits root_crop_traits_rootcrop_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.root_crop_traits
    ADD CONSTRAINT root_crop_traits_rootcrop_traits_id_fkey FOREIGN KEY (rootcrop_traits_id) REFERENCES public.rootcrop_traits(rootcrop_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 c   ALTER TABLE ONLY public.root_crop_traits DROP CONSTRAINT root_crop_traits_rootcrop_traits_id_fkey;
       public          postgres    false    4949    265    274            �           2606    43031 C   root_crop_traits root_crop_traits_vegetative_state_rootcrop_id_fkey    FK CONSTRAINT     
  ALTER TABLE ONLY public.root_crop_traits
    ADD CONSTRAINT root_crop_traits_vegetative_state_rootcrop_id_fkey FOREIGN KEY (vegetative_state_rootcrop_id) REFERENCES public.vegetative_state_rootcrop(vegetative_state_rootcrop_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 m   ALTER TABLE ONLY public.root_crop_traits DROP CONSTRAINT root_crop_traits_vegetative_state_rootcrop_id_fkey;
       public          postgres    false    4967    292    265            �           2606    43036 R   rootcrop_abiotic_resistance rootcrop_abiotic_resistance_abiotic_resistance_id_fkey    FK CONSTRAINT       ALTER TABLE ONLY public.rootcrop_abiotic_resistance
    ADD CONSTRAINT rootcrop_abiotic_resistance_abiotic_resistance_id_fkey FOREIGN KEY (abiotic_resistance_id) REFERENCES public.abiotic_resistance(abiotic_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 |   ALTER TABLE ONLY public.rootcrop_abiotic_resistance DROP CONSTRAINT rootcrop_abiotic_resistance_abiotic_resistance_id_fkey;
       public          postgres    false    267    4881    215            �           2606    43041 P   rootcrop_abiotic_resistance rootcrop_abiotic_resistance_root_crop_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_abiotic_resistance
    ADD CONSTRAINT rootcrop_abiotic_resistance_root_crop_traits_id_fkey FOREIGN KEY (root_crop_traits_id) REFERENCES public.root_crop_traits(root_crop_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 z   ALTER TABLE ONLY public.rootcrop_abiotic_resistance DROP CONSTRAINT rootcrop_abiotic_resistance_root_crop_traits_id_fkey;
       public          postgres    false    265    4937    267            �           2606    43046 R   rootcrop_disease_resistance rootcrop_disease_resistance_disease_resistance_id_fkey    FK CONSTRAINT       ALTER TABLE ONLY public.rootcrop_disease_resistance
    ADD CONSTRAINT rootcrop_disease_resistance_disease_resistance_id_fkey FOREIGN KEY (disease_resistance_id) REFERENCES public.disease_resistance(disease_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 |   ALTER TABLE ONLY public.rootcrop_disease_resistance DROP CONSTRAINT rootcrop_disease_resistance_disease_resistance_id_fkey;
       public          postgres    false    238    270    4907            �           2606    43051 P   rootcrop_disease_resistance rootcrop_disease_resistance_root_crop_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_disease_resistance
    ADD CONSTRAINT rootcrop_disease_resistance_root_crop_traits_id_fkey FOREIGN KEY (root_crop_traits_id) REFERENCES public.root_crop_traits(root_crop_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 z   ALTER TABLE ONLY public.rootcrop_disease_resistance DROP CONSTRAINT rootcrop_disease_resistance_root_crop_traits_id_fkey;
       public          postgres    false    270    265    4937            �           2606    43056 I   rootcrop_pest_resistance rootcrop_pest_resistance_pest_resistance_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_pest_resistance
    ADD CONSTRAINT rootcrop_pest_resistance_pest_resistance_id_fkey FOREIGN KEY (pest_resistance_id) REFERENCES public.pest_resistance(pest_resistance_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 s   ALTER TABLE ONLY public.rootcrop_pest_resistance DROP CONSTRAINT rootcrop_pest_resistance_pest_resistance_id_fkey;
       public          postgres    false    246    4915    271            �           2606    43061 J   rootcrop_pest_resistance rootcrop_pest_resistance_root_crop_traits_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.rootcrop_pest_resistance
    ADD CONSTRAINT rootcrop_pest_resistance_root_crop_traits_id_fkey FOREIGN KEY (root_crop_traits_id) REFERENCES public.root_crop_traits(root_crop_traits_id) ON UPDATE RESTRICT ON DELETE CASCADE;
 t   ALTER TABLE ONLY public.rootcrop_pest_resistance DROP CONSTRAINT rootcrop_pest_resistance_root_crop_traits_id_fkey;
       public          postgres    false    271    4937    265            �           2606    42802     users users_account_type_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_account_type_id_fkey FOREIGN KEY (account_type_id) REFERENCES public.account_type(account_type_id);
 J   ALTER TABLE ONLY public.users DROP CONSTRAINT users_account_type_id_fkey;
       public          postgres    false    217    284    4883            +   =   x�3��HM,�2�t)�/M�(�2�N����,��2��H,�M+�QJL�L,�������� �U�      -   )   x�3�t�K�OI-�2�tL����2�t.-J,�/����� ��	      /   7  x�%�1o�0�g߯`��*��$cH�TjԹ�#D�������>���|�w��ʨ����Xr�w���ا�\�/X�S�{,R�8F�+����11i�#�����wo�\C/Zg%!�6��i�*6����z��-DWoIKrc��Z��^�LY���D��w�G���ّ���b�&�����>�k,�c��1e�&1U�8ǀ����qz�bj������v[�	{U��k��&FG9R��|�㲸���m�f�ګ���Z�v��ilɇ+�܅�U0����)L�\��jƲ/�'���KD�Q�{      1   '   x�3���/Qp.�/�2��LN�2�t�/������ �P�      3   ^   x�3�4�tN,*�/�22�KK�L9M8C���S�2��L�\������Ģ�ԒJ.c��GeRQf
��!gN~yNb^
�!�Z f��qqq �2�      5   '   x�3�4�,�2�4��@҄�H�٦q0���� �)�      6   4   x�3�,�)N-�22<RKJ��L�,w��H*������ ��24��b���� �u      8   -   x�3�4�,�2�4�F��@�,b1�M!�`��b���� -�	�      9   g   x�5��� ߡ�� ҋe��(����a'a^�)aC�d
�Kg��@�\`�eJ�)a"L�Zw�fS)_U��6�~�	h���d����WL���QJy��,�      :   /   x�3�,��H-)1�2��SK���tHjqI	��!��ehc��qqq j�      <   _   x�-���0�R1��4A�_
av?�/�#?��G�Aͽ�Bc�.�ܖqb�]TF�Nz4�=�{@�֎����-w�V�n,��� �l�      >   �  x�u��n1���O������.��&�B��*7��U�jQ@}��� KB�ػ,�o��,�u�]�_톀��Ʉ����`�p��%���龖�k��ݮ�1$/�ѦH�D!�$�F8B��	�������G�I�*�.��u��B�d0�ݶ�o�N��Rq���9S�z ��˶��=kr���m�1\�+(6Qt�����>2���v،� ,�
G�Ņ�J�&�����XmVC��U�6H|Aエ�Z�1�G��NJ<CQ�Ĥe�`���^���GE�,�!<TÏ�3+ ���bt�^a�|����u,�Sι��_?��
�=�>���>`���(�3QNR�%�Ư�r4
[t���%5�f���a��ތMD�I�(����e�湸h�8��cv���~~-I�ZF��$���,�`�2y�Qj�g�ס��2ڥ���+�62��	���}=_�6h��1�?_���      @   �   x����N�@k�)x ��vIB�k���h�B<>�wɕ@?��S@6E�^_�1G�-�1i�r@> �f�P�ۥ��w :�i����<�K��p�����x�f3SX��J/xX>p�f����9TkC��n�#�1�K���֜i ��X������s5�[˽��>OX�\bE�m�ӄ��/��ve�ԮL����7
��p�tx����OFN��Ä�?��Y�      B   )   x�3�tJL.I-�L��2�t+�K/-�2��,
��qqq ��	u      D   '   x�3�tI,N142�tLI�1~��P0�eJXI� ���      F   y   x�}�1
�0@��:E/cɒ�z˔��](�अ&��Iǂ���C76��Q $'���K�t���V]f�wuS���R�PMߺ�j�����|����+��SA��U��\�{ ���9�      H       x�3�t,N142Q��P��2% ���� \,�      J   �   x�=��N�@E��_1?P���e���.Z�l�L���N2�gB���4��}��c���h�S�|H4�s�!Z��q5��J��)�����O���f�5��:�e�mqtZ�)Ji~L�Q*�sr{=�y�4�>��|ԕ�ū�X��{Kc����'�V�7.�z0�Q]�e��?+n��Ҍ�-*�������X�t��@D��WM      L   2   x�3�N,J�KO���4202�50�52U04�2"=K#SK�=... �l	�      N      x������ � �      P   W   x�3���/׍�L�I��K�4�2���L�@��s�*1�����44��F\�hZ,��RF�\F`�	��!�a�ed���Ȍ+F��� �"�      R   -   x�3���L�Ѝ�L�I��K�4��4�2E5�42�4����� b��      T      x�3�4�,�2�4��`�)����� E=      U      x�3�,�J-.�22���̠t� e�      W      x�3�4�,�2�1z\\\ v�      X   :   x�3��,�2�44�P
BZ@(3e�L!*L�*L!�L�F�BԙBt�B���qqq *^(      Y      x�3�,�J-.�22���̠t� e�      [   $   x�3�44�4CN.SNcNS04�4����� Q5k      ]      x�3�46�4�@.3NcKNs����� A�      _      x�3�4�,�2�1z\\\ ��      `      x�3�,�K�342�2G0c���� V��      b      x�3�4�,�2�4�f`������ E��      c   $   x�3�4�,�2�4��P�@�,f3����qqq �?S      d      x�3�,�K�342�2G0c���� V��      f      x�3�K�342�Jq�㕍���� !Q      h   ]   x�3��H-)1�$��9�SK�1�1gHjq�Q	gp*�eh��G\�F(\N��0NI���%D&�ed�����k��5�f��9��1z\\\ �9�      j   #   x�3�t,N142F�A4'�GbQ
�)~�=... d      l   "  x����N�0E��W����Ǟbώ]7iQ%�D����B��%�X�F���&G�ddE�c�(�Y)������0��ۦs��Ѡ�Bj�,&��Yt)���~X~��,d��P�E �,���@&�]7����٠��c�"!tC�v�'�o��qU��~��7��h���kc�QsJW�Xf��*�2��U�tF�cX"�Ry����#�X�b(�Bj�kP�5M��;;z���O�m?N������3Nd
�RH����?!�^�y#�SurU���BЌ%��1kh���4�M      n   9   x�3���/��K�2�����)�LI�2�.IM-�2����Ir��$�p��qqq ��p      p   �  x�}�Ko�0��ί��u���s�n`��y���i�y��CI~}UՖ�V�4��o>� Z���ҢHA�>���\TuZ����U���ǒ�x_�`L�1F�|�����g���7�OD�-6�6�t�E���󚹁~&D6ubʁ��/`@Q~��3FȰ�fauC�Y����	��6-�H[�Y/I�!��nվ /����B����Z������9����]��?=Z�_�:Xa�R#��b ") n�D�a ������r?�BLʍ_�Y'2rCY��s�S�שa?����w���e��"F4�1����i�:T0F�*�@4�e���㛔�=*M��{����0���R��[�|�发:�����I<z��?��#�,Y�dM���J��
cE�)      r   m   x�}���0Du�c�6$
�Bf1��3����w/W�LC���˧�gKݹ���#XL�L�v�G	`KCP�o�ꃦ��������6��DE���������_�p�IMZ      t   Z   x�3���/*��K,*�/�rb���8C*2�s8�R��S�4P��& G\�(<sΐĜ����t��!�"#T�!*��1z\\\ ��6�      v   [   x�3���/*��,�P(-*��,�P.)�,H-�t,K-JLO���L�P���I-��K�tM,ʩT�M,)q5�s��J2�5�L�iX� sX6�      x   1   x�3�I����LI����K�K�342���2���/*�*���� 	�     