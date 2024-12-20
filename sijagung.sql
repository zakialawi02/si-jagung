PGDMP                     
    |            sijagung    14.11    14.11 ;    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    36760    sijagung    DATABASE     h   CREATE DATABASE sijagung WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_Indonesia.1252';
    DROP DATABASE sijagung;
                postgres    false                        3079    36761    postgis 	   EXTENSION     ;   CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;
    DROP EXTENSION postgis;
                   false            �           0    0    EXTENSION postgis    COMMENT     ^   COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';
                        false    2            �           1255    38574    delete_from_lahan_view()    FUNCTION     5  CREATE FUNCTION public.delete_from_lahan_view() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
            BEGIN
                DELETE FROM lahan_kebuns WHERE id = OLD.id;
                DELETE FROM lahan_revieweds WHERE lahan_kebun_id = OLD.id;
                RETURN OLD;
            END;
            $$;
 /   DROP FUNCTION public.delete_from_lahan_view();
       public          postgres    false            �           1255    38572    insert_into_lahan_view()    FUNCTION     �  CREATE FUNCTION public.insert_into_lahan_view() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
            BEGIN
                INSERT INTO lahan_kebuns (id, user_id, no_kebun, nama_pemilik, luas, jumlah_produksi, jenis_jagung, varietas_jagung, kontak, geom, created_at, updated_at)
                VALUES (NEW.id, NEW.user_id, NEW.no_kebun, NEW.nama_pemilik, NEW.luas, NEW.jumlah_produksi, NEW.jenis_jagung, NEW.varietas_jagung, NEW.kontak, NEW.geom, NOW(), NOW());

                INSERT INTO lahan_revieweds (lahan_kebun_id, reviewed, reviewed_at, created_at, updated_at)
                VALUES (NEW.id, NEW.reviewed, NEW.reviewed_at, NOW(), NOW());
                RETURN NEW;
            END;
            $$;
 /   DROP FUNCTION public.insert_into_lahan_view();
       public          postgres    false            �           1255    38486    update_lahan_kebun_reviews()    FUNCTION     6  CREATE FUNCTION public.update_lahan_kebun_reviews() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
            BEGIN
                -- Insert ke lahan_kebuns dan lahan_revieweds pada operasi INSERT di view
                IF (TG_OP = 'INSERT') THEN
                    INSERT INTO lahan_kebuns (id, nama_pemilik, luas, geom)
                    VALUES (NEW.kebun_id, NEW.nama_pemilik, NEW.luas, NEW.geom);

                    INSERT INTO lahan_revieweds (lahan_kebun_id, reviewed, reviewed_at)
                    VALUES (NEW.kebun_id, NEW.reviewed, NEW.reviewed_at);

                    RETURN NEW;

                -- Update ke lahan_kebuns dan lahan_revieweds pada operasi UPDATE di view
                ELSIF (TG_OP = 'UPDATE') THEN
                    UPDATE lahan_kebuns
                    SET
                        nama_pemilik = NEW.nama_pemilik,
                        luas = NEW.luas,
                        geom = NEW.geom
                    WHERE id = NEW.kebun_id;

                    UPDATE lahan_revieweds
                    SET
                        reviewed = NEW.reviewed,
                        reviewed_at = NEW.reviewed_at
                    WHERE lahan_kebun_id = NEW.kebun_id;

                    RETURN NEW;
                END IF;
                RETURN NULL;
            END;
            $$;
 3   DROP FUNCTION public.update_lahan_kebun_reviews();
       public          postgres    false            �           1255    38573    update_lahan_view()    FUNCTION     �  CREATE FUNCTION public.update_lahan_view() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
            BEGIN
                UPDATE lahan_kebuns
                SET
                    no_kebun = NEW.no_kebun,
                    nama_pemilik = NEW.nama_pemilik,
                    luas = NEW.luas,
                    jumlah_produksi = NEW.jumlah_produksi,
                    jenis_jagung = NEW.jenis_jagung,
                    varietas_jagung = NEW.varietas_jagung,
                    kontak = NEW.kontak,
                    geom = NEW.geom,
                    updated_at = NOW()
                WHERE id = OLD.id;

                UPDATE lahan_revieweds
                SET
                    reviewed = NEW.reviewed,
                    reviewed_at = NEW.reviewed_at,
                    updated_at = NOW()
                WHERE lahan_kebun_id = OLD.id;
                RETURN NEW;
            END;
            $$;
 *   DROP FUNCTION public.update_lahan_view();
       public          postgres    false            �            1259    44982    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    44981    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    220            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    219            �            1259    45006    lahan_kebuns    TABLE        CREATE TABLE public.lahan_kebuns (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    no_kebun character varying(255),
    nama_pemilik character varying(255) NOT NULL,
    luas double precision,
    jumlah_produksi double precision,
    jenis_jagung character varying(255) NOT NULL,
    varietas_jagung character varying(255),
    kontak character varying(255),
    geom public.geography(Geometry,4326) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
     DROP TABLE public.lahan_kebuns;
       public         heap    postgres    false    2    2    2    2    2    2    2    2            �            1259    45019    lahan_revieweds    TABLE       CREATE TABLE public.lahan_revieweds (
    id bigint NOT NULL,
    lahan_kebun_id uuid NOT NULL,
    reviewed boolean DEFAULT false NOT NULL,
    reviewed_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 #   DROP TABLE public.lahan_revieweds;
       public         heap    postgres    false            �            1259    45018    lahan_revieweds_id_seq    SEQUENCE        CREATE SEQUENCE public.lahan_revieweds_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.lahan_revieweds_id_seq;
       public          postgres    false    225            �           0    0    lahan_revieweds_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.lahan_revieweds_id_seq OWNED BY public.lahan_revieweds.id;
          public          postgres    false    224            �            1259    44953 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    44952    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    216            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    215            �            1259    44974    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    44994    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
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
       public         heap    postgres    false            �            1259    44993    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    222            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    221            �            1259    44959    users    TABLE     P  CREATE TABLE public.users (
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
       public         heap    postgres    false            �            1259    45031 
   view_lahan    VIEW     �  CREATE VIEW public.view_lahan AS
 SELECT lk.id,
    lk.user_id,
    lk.no_kebun,
    lk.nama_pemilik,
    lk.luas,
    lk.jumlah_produksi,
    lk.jenis_jagung,
    lk.varietas_jagung,
    lk.kontak,
    lk.geom,
    lk.created_at,
    lk.updated_at,
    lr.reviewed,
    lr.reviewed_at
   FROM (public.lahan_kebuns lk
     LEFT JOIN public.lahan_revieweds lr ON ((lk.id = lr.lahan_kebun_id)));
    DROP VIEW public.view_lahan;
       public          postgres    false    223    223    223    223    223    223    223    223    223    223    223    223    225    225    225    2    2    2    2    2    2    2    2            !           2604    44985    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    219    220    220            %           2604    45022    lahan_revieweds id    DEFAULT     x   ALTER TABLE ONLY public.lahan_revieweds ALTER COLUMN id SET DEFAULT nextval('public.lahan_revieweds_id_seq'::regclass);
 A   ALTER TABLE public.lahan_revieweds ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    224    225                       2604    44956    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            #           2604    44997    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221    222            �          0    44982    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    220   sY       �          0    45006    lahan_kebuns 
   TABLE DATA           �   COPY public.lahan_kebuns (id, user_id, no_kebun, nama_pemilik, luas, jumlah_produksi, jenis_jagung, varietas_jagung, kontak, geom, created_at, updated_at) FROM stdin;
    public          postgres    false    223   �Y       �          0    45019    lahan_revieweds 
   TABLE DATA           l   COPY public.lahan_revieweds (id, lahan_kebun_id, reviewed, reviewed_at, created_at, updated_at) FROM stdin;
    public          postgres    false    225   r]       �          0    44953 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    216   ^       �          0    44974    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    218   �^       �          0    44994    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
    public          postgres    false    222   _                 0    37078    spatial_ref_sys 
   TABLE DATA           X   COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
    public          postgres    false    211   !_       �          0    44959    users 
   TABLE DATA           �   COPY public.users (id, name, username, email, email_verified_at, password, remember_token, profile_photo_path, role, created_at, updated_at, deleted_at) FROM stdin;
    public          postgres    false    217   >_       �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    219            �           0    0    lahan_revieweds_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.lahan_revieweds_id_seq', 4, true);
          public          postgres    false    224            �           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 8, true);
          public          postgres    false    215            �           0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    221            4           2606    44990    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    220            6           2606    44992 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    220            =           2606    45017    lahan_kebuns lahan_kebuns_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.lahan_kebuns
    ADD CONSTRAINT lahan_kebuns_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.lahan_kebuns DROP CONSTRAINT lahan_kebuns_pkey;
       public            postgres    false    223            ?           2606    45025 $   lahan_revieweds lahan_revieweds_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.lahan_revieweds
    ADD CONSTRAINT lahan_revieweds_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.lahan_revieweds DROP CONSTRAINT lahan_revieweds_pkey;
       public            postgres    false    225            *           2606    44958    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    216            2           2606    44980 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    218            8           2606    45002 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    222            :           2606    45005 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    222            ,           2606    44973    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    217            .           2606    44969    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    217            0           2606    44971    users users_username_unique 
   CONSTRAINT     Z   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);
 E   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_unique;
       public            postgres    false    217            ;           1259    45003 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    222    222            B           2620    45038 $   view_lahan delete_lahan_view_trigger    TRIGGER     �   CREATE TRIGGER delete_lahan_view_trigger INSTEAD OF DELETE ON public.view_lahan FOR EACH ROW EXECUTE FUNCTION public.delete_from_lahan_view();
 =   DROP TRIGGER delete_lahan_view_trigger ON public.view_lahan;
       public          postgres    false    226    995            D           2620    45036 $   view_lahan insert_lahan_view_trigger    TRIGGER     �   CREATE TRIGGER insert_lahan_view_trigger INSTEAD OF INSERT ON public.view_lahan FOR EACH ROW EXECUTE FUNCTION public.insert_into_lahan_view();
 =   DROP TRIGGER insert_lahan_view_trigger ON public.view_lahan;
       public          postgres    false    226    993            C           2620    45037 $   view_lahan update_lahan_view_trigger    TRIGGER     �   CREATE TRIGGER update_lahan_view_trigger INSTEAD OF UPDATE ON public.view_lahan FOR EACH ROW EXECUTE FUNCTION public.update_lahan_view();
 =   DROP TRIGGER update_lahan_view_trigger ON public.view_lahan;
       public          postgres    false    226    994            @           2606    45011 )   lahan_kebuns lahan_kebuns_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.lahan_kebuns
    ADD CONSTRAINT lahan_kebuns_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON UPDATE CASCADE ON DELETE CASCADE;
 S   ALTER TABLE ONLY public.lahan_kebuns DROP CONSTRAINT lahan_kebuns_user_id_foreign;
       public          postgres    false    223    4142    217            A           2606    45026 6   lahan_revieweds lahan_revieweds_lahan_kebun_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.lahan_revieweds
    ADD CONSTRAINT lahan_revieweds_lahan_kebun_id_foreign FOREIGN KEY (lahan_kebun_id) REFERENCES public.lahan_kebuns(id) ON UPDATE CASCADE ON DELETE CASCADE;
 `   ALTER TABLE ONLY public.lahan_revieweds DROP CONSTRAINT lahan_revieweds_lahan_kebun_id_foreign;
       public          postgres    false    225    4157    223            �      x������ � �      �   �  x���Yr�6���S���4��y�,i�'������H+�R��RY2?6������|��|����g=?�,B`<Љ��w�y���K���f�3rF��	�i���3M�zܡGe�,x�;b��8|=<-OM����v4�p���8�����hc���sv>b/�����g���@���SZ�i�>QΘ��=�-��k"��˕���:<�mƹw�;���m�-��o�w���__G|�9)I�BsX!:��k��\��O1j&�����ܚ�դ�k��S��:�֟!@�%�����1�����-����h�w�o���˹X2���8��K�[���Mk� ��R4�ֿ%����v�[���ˍtۿ�j����/3��_$�5�/�EOk~d�ܛ���|�6���t�)��ꫮ�P���2u�l�����Fapj��p���"���8#} ����^ܳ{�W���Ñ�l�̇��G9� ����ۃ��W�B�����O_�G"3�*�.*&G.N�Ɏ�L_�����������>��g֧��jM��@���$���.�W�ԝȃۿ�H��/��%,�W�\�|<6��O�)�nqU|��ͳ�BZy)TE$�\@(%��J�\��Z��l�N��+6�(%����t����g�H�6�6�;ف�rۨ��J��*��i�߀/
y�L���5���'M�6��{�Ի9W��s�ʚJH�h�~<��K	��?'�n������gk�]��u;L�->
ʣ����G������=�p�F�xts49��x�ٟ�<���k�x����2}��ьa�	��C4Q����+Rw��f�oO�O�3����&��e�!�]�M�1u�S�k_=F�Z���f�YGt���I!v�\iӥi<ٙM�� ZC�o�r�*זh���r5e�˪��<}嶁��J�/�u1������6#� hڣ޻�������9��      �   �   x�m��� �3T�6b?�B����WA�Wl)�D�u4�]Ygkr�B���B�qp_��"���Q D@ڈj�*�)��5�y ��uv��9gN�h�{�����by�y�N
�&P��РY6H#N��h��{�۵<�p�P�z�xy�?zK>�      �   �   x�u���0F��aL;7`�b���.�lC_��{ѫs��)��$BA�j=��4���i,�9��fBx8ߑ�����򸊇Y�5�{#��`���kV\��D�q\z�=n4�L�r�E*�"]�A��T_Ӛ���͔�eΣ>H[��}�w�R-J�h�J��#$��IYJ��~�{�tr��|�E��U�!      �      x������ � �      �      x������ � �            x������ � �      �   }  x���Ms�0��9p��iY�SH����M�E�%p�1��!�׷1$'�i/�;{y�G�(���#HX�+��,6�9ŉ
��2�\���.�o�q~)u^��*F�@�"�.�p�i�gm��>h���uYk:�h�ê5��>�8B���n����p�z�5[mʇ�� �v/5��%��*�w��v�<�8�{��<k$8$�͐0F C�CJ+#<� x��/nw�����Fe�GӒ��<���o�������Ƴ�ے
_\��ϒ�;���3�1�����K>����\IA$G��B�EF(�8uT��Q�� u˦�'m�>�Iz��!Σd�m�4�nU�L�$���O��]h���c����}���-�sv�C�{��o�Ƶ     