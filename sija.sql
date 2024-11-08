PGDMP         &            
    |            sijagung    14.11    14.11 3    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    34278    sijagung    DATABASE     h   CREATE DATABASE sijagung WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_Indonesia.1252';
    DROP DATABASE sijagung;
                postgres    false                        3079    34279    postgis 	   EXTENSION     ;   CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;
    DROP EXTENSION postgis;
                   false            �           0    0    EXTENSION postgis    COMMENT     ^   COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';
                        false    2            �            1259    36710    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    36709    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    220            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    219            �            1259    36734    lahan_kebuns    TABLE     �  CREATE TABLE public.lahan_kebuns (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    no_kebun character varying(255),
    nama_pemilik character varying(255) NOT NULL,
    luas double precision,
    jumlah_produksi double precision,
    jenis_jagung character varying(255) NOT NULL,
    varietas_jagung character varying(255),
    geom public.geography(Geometry,4326) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
     DROP TABLE public.lahan_kebuns;
       public         heap    postgres    false    2    2    2    2    2    2    2    2            �            1259    36747    lahan_revieweds    TABLE       CREATE TABLE public.lahan_revieweds (
    id bigint NOT NULL,
    lahan_kebun_id uuid NOT NULL,
    reviewed boolean DEFAULT false NOT NULL,
    reviewed_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 #   DROP TABLE public.lahan_revieweds;
       public         heap    postgres    false            �            1259    36746    lahan_revieweds_id_seq    SEQUENCE        CREATE SEQUENCE public.lahan_revieweds_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.lahan_revieweds_id_seq;
       public          postgres    false    225            �           0    0    lahan_revieweds_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.lahan_revieweds_id_seq OWNED BY public.lahan_revieweds.id;
          public          postgres    false    224            �            1259    36681 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    36680    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    216            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    215            �            1259    36702    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    36722    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    36721    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    222            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    221            �            1259    36687    users    TABLE     P  CREATE TABLE public.users (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    profile_photo_path character varying(2048) DEFAULT '/assets/img/profile/user.png'::character varying NOT NULL,
    role character varying(255) DEFAULT 'user'::character varying NOT NULL,
    created_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['admin'::character varying, 'writer'::character varying, 'user'::character varying])::text[])))
);
    DROP TABLE public.users;
       public         heap    postgres    false                       2604    36713    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219    220                       2604    36750    lahan_revieweds id    DEFAULT     x   ALTER TABLE ONLY public.lahan_revieweds ALTER COLUMN id SET DEFAULT nextval('public.lahan_revieweds_id_seq'::regclass);
 A   ALTER TABLE public.lahan_revieweds ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224    225                       2604    36684    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    215    216    216                       2604    36725    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    221    222    222            �          0    36710    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    220   &B       �          0    36734    lahan_kebuns 
   TABLE DATA           �   COPY public.lahan_kebuns (id, user_id, no_kebun, nama_pemilik, luas, jumlah_produksi, jenis_jagung, varietas_jagung, geom, created_at, updated_at) FROM stdin;
    public          postgres    false    223   CB       �          0    36747    lahan_revieweds 
   TABLE DATA           l   COPY public.lahan_revieweds (id, lahan_kebun_id, reviewed, reviewed_at, created_at, updated_at) FROM stdin;
    public          postgres    false    225   `B       �          0    36681 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    216   }B       �          0    36702    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    218   +C       �          0    36722    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
    public          postgres    false    222   HC                 0    34596    spatial_ref_sys 
   TABLE DATA           X   COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
    public          postgres    false    211   eC       �          0    36687    users 
   TABLE DATA           �   COPY public.users (id, name, username, email, email_verified_at, password, remember_token, profile_photo_path, role, created_at, updated_at, deleted_at) FROM stdin;
    public          postgres    false    217   �C       �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    219            �           0    0    lahan_revieweds_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.lahan_revieweds_id_seq', 1, false);
          public          postgres    false    224            �           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 6, true);
          public          postgres    false    215            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    221            ,           2606    36718    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    220            .           2606    36720 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    220            5           2606    36745    lahan_kebuns lahan_kebuns_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.lahan_kebuns
    ADD CONSTRAINT lahan_kebuns_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.lahan_kebuns DROP CONSTRAINT lahan_kebuns_pkey;
       public            postgres    false    223            7           2606    36753 $   lahan_revieweds lahan_revieweds_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.lahan_revieweds
    ADD CONSTRAINT lahan_revieweds_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.lahan_revieweds DROP CONSTRAINT lahan_revieweds_pkey;
       public            postgres    false    225            "           2606    36686    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    216            *           2606    36708 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    218            0           2606    36730 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    222            2           2606    36733 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    222            $           2606    36701    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    217            &           2606    36697    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    217            (           2606    36699    users users_username_unique 
   CONSTRAINT     Z   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);
 E   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_unique;
       public            postgres    false    217            3           1259    36731 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    222    222            8           2606    36739 )   lahan_kebuns lahan_kebuns_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.lahan_kebuns
    ADD CONSTRAINT lahan_kebuns_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;
 S   ALTER TABLE ONLY public.lahan_kebuns DROP CONSTRAINT lahan_kebuns_user_id_foreign;
       public          postgres    false    4134    223    217            9           2606    36754 6   lahan_revieweds lahan_revieweds_lahan_kebun_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.lahan_revieweds
    ADD CONSTRAINT lahan_revieweds_lahan_kebun_id_foreign FOREIGN KEY (lahan_kebun_id) REFERENCES public.lahan_kebuns(id) ON UPDATE CASCADE ON DELETE CASCADE;
 `   ALTER TABLE ONLY public.lahan_revieweds DROP CONSTRAINT lahan_revieweds_lahan_kebun_id_foreign;
       public          postgres    false    225    223    4149            �      x������ � �      �      x������ � �      �      x������ � �      �   �   x�]�A�0��5=���.&/�i��E�/H����?o(3�,H����I0F	�+/)��t�O�qB� Q��I�����,�!�q��c�6nW��ؕ�og�g�ك�Zb�rsi�	�]8gݷ�|��T��{Oen�>� �V&i��zRJ�9`      �      x������ � �      �      x������ � �            x������ � �      �   v  x����R�0�uy
lSrkӸ��r� u؄4)Qh!��W�tF7'g�L��?�� R@d22	`$��(�pA�f�6�E����z�WkaV�,����>?]`r��%E^��ߓ�.��пս<��w�v�����>+K՞��T϶�����n�:bo>��9�s��[j�R�*�����O�?���Z����� )� E��E$C�UZ�cB��5;eOзj??�&vi��d�Β��ڦj9�9?1��n�ݳ��&�/�c�r����r+��?�3�Z.�P*1e ��cBC�MT�_��v�=�$��xT�V:�-h;���p4�I��ڽCl�c�^�a��Ϋ�c��~�~�VΪ�?�s�V�} ��     